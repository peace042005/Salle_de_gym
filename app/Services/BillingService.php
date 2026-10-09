<?php

namespace App\Services;

use App\Http\Controllers\Billing\PurchaseController;
use App\Http\Controllers\Billing\SubscriptionController;
use App\Http\Controllers\Billing\TransactionController;
use App\Models\Outfit;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BillingService
{
    public function todoAfterSuccessTransaction(
        $reference,
        $amount,
        $amountTtc,
        $status,
        $option,
        $pricingId,
        $roomId = null,
        $outfitId = null,
        $userId
    ) {
        $mailService = new MailService();
        $transactionController = new TransactionController();
        $purchaseController = new PurchaseController();
        $subscriptionController = new SubscriptionController();

        // DB::beginTransaction();
        $check = Transaction::where('reference', $reference)->first();

        if(!$check) {
            $transaction = $transactionController->store(
                $reference,
                $amount,
                $amountTtc,
                $option,
                $status,
                $pricingId,
                $roomId,
                $outfitId,
                $userId
            );
            
            // get customer info
            $customer = User::find($transaction->user_id);

            if ($transaction->option === "purchase") {
                // create purchase for user
                $purchase = $purchaseController->store(
                    $transaction->id,
                    $transaction->amount,
                    $transaction->pricing_id,
                    $transaction->outfit_id,
                    $transaction->user_id,
                );
    
                // 2. send mail the customer
                $mailService->sendNewPurchaseMailToCustomer(
                    $customer,
                    $transaction,
                    Outfit::find($transaction->outfit_id),
                );
    
                // echo "Assouka Numeric Purchase, SUCCESS !";
            } else if($transaction->option === "subscription"){
                // create subscription for user
                $subscription = $subscriptionController->store(
                    $transaction->id,
                    $transaction->amount,
                    $transaction->pricing_id,
                    $transaction->room_id,
                    $transaction->user_id,
                );
    
                // 4.. send mail the customer
                $mailService->sendNewSubscriptionMailToCustomer(
                    $customer,
                    $transaction,
                    $subscription
                );
            }
        }
        // DB::commit();
    }
}
