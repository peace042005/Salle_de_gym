<?php

namespace App\Services;

class FedapayService
{
    public function createUser()
    {
        /* Remplacez VOTRE_CLE_API_SECRETE par votre clé API secrète */
        \FedaPay\FedaPay::setApiKey( env('FEDAPAY_SECRET_KEY') );

        /* Précisez si vous souhaitez exécuter votre requête en mode test ou live */
        \FedaPay\FedaPay::setEnvironment('sandbox'); //ou setEnvironment('live');

        /* Créer le client */
        \FedaPay\Customer::create(array(
            "firstname" => "Firdaous",
            "lastname" => "Mohamed",
            "email" => "mohamedfidorce@gmail.com",
            "phone_number" => [
                "number" => "+22950733202",
                "country" => 'bj' // 'bj' code indicatif du Bénin
            ]
        ));
    }

    public function useCheckout()
    {
        if (isset($_COOKIE['approuvedTransaction'])) {
            $transInfo = json_decode($_COOKIE['approuvedTransaction']);

            ($transInfo->custom_metadata->room_id === "null") ? $sentRoomId = null : $sentRoomId = intval($transInfo->custom_metadata->room_id);
            ($transInfo->custom_metadata->outfit_id === "null") ? $sentOutfitId = null : $sentOutfitId = intval($transInfo->custom_metadata->outfit_id);
            ($transInfo->custom_metadata->pricing_id === "null") ? $sentPricingId = null : $sentPricingId = intval($transInfo->custom_metadata->pricing_id);
            
            $digitpayService = new BillingService();
            $digitpayService->todoAfterSuccessTransaction(
                $reference = $transInfo->reference,
                $amount = $transInfo->amount,
                $amountTtc = $transInfo->amount_debited,
                $status = $transInfo->status,
                $option = $transInfo->custom_metadata->option,
                $pricingId =  $sentPricingId,
                $roomId = $sentRoomId,
                $outfitId = $sentOutfitId,
                $userId = intval($transInfo->custom_metadata->user_id)
            );

            if($sentRoomId == null && $sentOutfitId == null && $sentPricingId == null) {
                return 'isManager';
            }
        }
    }
}
