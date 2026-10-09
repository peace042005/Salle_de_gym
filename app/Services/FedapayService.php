<?php

namespace App\Services;

use App\Models\Outfit;
use App\Models\Pricing;
use App\Models\Room;
use FedaPay\FedaPay;
use FedaPay\Transaction as FedaPayTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Validation des paiements FedaPay.
 *
 * Après un paiement, le widget FedaPay dépose dans un cookie l'identifiant de la
 * transaction. Ce cookie peut être modifié par n'importe quel utilisateur : on n'en
 * garde donc QUE l'identifiant, puis on interroge directement l'API FedaPay pour
 * vérifier que la transaction existe, qu'elle est approuvée, qu'elle appartient à
 * l'utilisateur connecté et que le montant payé correspond au prix attendu.
 */
class FedapayService
{
    public const COOKIE = 'approuvedTransaction';

    /**
     * @return string|null 'isManager' quand le paiement validé est le passage au statut de gérant
     */
    public function useCheckout()
    {
        if (! isset($_COOKIE[self::COOKIE]) || ! Auth::check()) {
            return null;
        }

        $transactionId = json_decode($_COOKIE[self::COOKIE])->id ?? null;

        // Le cookie ne sert qu'une fois
        setcookie(self::COOKIE, '', time() - 3600, '/');
        unset($_COOKIE[self::COOKIE]);

        $transaction = $this->retrieveApprovedTransaction($transactionId);
        if (! $transaction) {
            return null;
        }

        $metadata = $transaction->custom_metadata;
        $option = $metadata->option ?? null;
        $pricingId = $this->toId($metadata->pricing_id ?? null);
        $roomId = $this->toId($metadata->room_id ?? null);
        $outfitId = $this->toId($metadata->outfit_id ?? null);
        $userId = $this->toId($metadata->user_id ?? null);

        // La transaction doit avoir été payée par l'utilisateur connecté
        if ($userId !== Auth::id()) {
            Log::warning('FedaPay : transaction d\'un autre utilisateur', ['transaction' => $transactionId]);

            return null;
        }

        $expectedAmount = $this->expectedAmount($option, $pricingId, $roomId, $outfitId);
        if ($expectedAmount === null || (int) $transaction->amount !== $expectedAmount) {
            Log::warning('FedaPay : montant ou contenu incohérent', ['transaction' => $transactionId]);

            return null;
        }

        (new BillingService())->todoAfterSuccessTransaction(
            $transaction->reference,
            $transaction->amount,
            $transaction->amount_debited ?? $transaction->amount,
            $transaction->status,
            $option,
            $pricingId,
            $roomId,
            $outfitId,
            $userId
        );

        if ($roomId === null && $outfitId === null && $pricingId === null) {
            return 'isManager';
        }

        return null;
    }

    /**
     * Interroge l'API FedaPay et renvoie la transaction si elle est approuvée.
     */
    private function retrieveApprovedTransaction($transactionId)
    {
        $secretKey = config('services.fedapay.secret_key');

        if (! $transactionId || ! $secretKey) {
            return null;
        }

        try {
            FedaPay::setApiKey($secretKey);
            FedaPay::setEnvironment(config('services.fedapay.environment'));

            $transaction = FedaPayTransaction::retrieve($transactionId);
        } catch (\Exception $e) {
            Log::error('FedaPay : vérification impossible', ['message' => $e->getMessage()]);

            return null;
        }

        return $transaction->status === 'approved' ? $transaction : null;
    }

    /**
     * Montant attendu (en FCFA) selon ce qui a été payé, calculé depuis la base.
     */
    private function expectedAmount(?string $option, ?int $pricingId, ?int $roomId, ?int $outfitId): ?int
    {
        // Achat d'un équipement
        if ($option === 'purchase' && $outfitId) {
            return ($outfit = Outfit::find($outfitId)) ? (int) $outfit->sale_price : null;
        }

        // Passage au statut de gérant
        if ($option === 'subscription' && ! $pricingId && ! $roomId && ! $outfitId) {
            return (int) config('services.fedapay.manager_fee');
        }

        // Abonnement à une salle : la formule doit être proposée par cette salle
        if ($option === 'subscription' && $pricingId && $roomId) {
            $room = Room::find($roomId);
            $pricing = $room?->pricings()->whereKey($pricingId)->first();

            return $pricing ? (int) $pricing->price : null;
        }

        return null;
    }

    private function toId($value): ?int
    {
        return ($value === null || $value === 'null' || $value === '') ? null : (int) $value;
    }
}
