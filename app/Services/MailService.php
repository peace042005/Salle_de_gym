<?php

namespace App\Services;

use App\Mail\NewPurchaseMail;
use App\Mail\NewSubscriptionMail;
use Illuminate\Support\Facades\Mail;

class MailService
{
    // PURCHASE
    public function sendNewPurchaseMailToCustomer($customerData, $transactionData, $purchasedOutfitData)
    {
        Mail::to($customerData->email)->send(
            new NewPurchaseMail([
                'customer_info' => $customerData,
                'transaction_info' => $transactionData,
                'outfit_info' => $purchasedOutfitData,
            ])
        );
    }

    // SUBSCRIPTION
    public function sendNewSubscriptionMailToCustomer($customerData, $transactionData, $subscriptionData)
    {
        Mail::to($customerData->email)->send(
            new NewSubscriptionMail([
                'customer_info' => $customerData,
                'transaction_info' => $transactionData,
                'subscription_info' => $subscriptionData
            ])
        );
    }
}
