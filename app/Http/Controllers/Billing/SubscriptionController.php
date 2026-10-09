<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\Pricing;
use App\Models\Room;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public $authenticatedUser;

    /**
     * 
     */
    public function __construct()
    {
        $this->authenticatedUser = Auth::user();
    }
    
    /**
     * 
     */
    public function index()
    { 
        try {
            if ($this->authenticatedUser->role == "admin") {
                // list of subscriptions
                $allRoomsID = Room::pluck('id');
                $subscriptionsList = Subscription::whereIn('room_id', $allRoomsID)->get();

                // list of subscribers
                $ids = $subscriptionsList->pluck('user_id');
                $subscribersList = User::whereIn('id', $ids)->get();
            } else {
                // list of subscriptions
                $roomsAddByManagerID = Room::addedByManager($this->authenticatedUser->id)->pluck('id');
                $subscriptionsList = Subscription::whereIn('room_id', $roomsAddByManagerID)->get();

                // list of subscribers
                $ids = Subscription::whereIn('room_id', $roomsAddByManagerID)->pluck('user_id');
                $subscribersList = User::with('subscriptions')->whereIn('id', $ids)->get();
            }

            // dd($subscribersList);

            return view('site.private.subscription.index', [
                "subscriptionsList" => $subscriptionsList,
                "subscribersList" => $subscribersList,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 
     */
    public function store(
        $transactionId,
        $transactionAmount,
        $transactionPricingId = null,
        $transactionRoomId = null,
        $transactionUserId,
    )
    {
        // DB::beginTransaction();
        // managers subscriptions
        $expiration = now()->addDays(365);

        // rooms subscriptions
        if(isset($transactionPricingId)) {
            $pricing = Pricing::find($transactionPricingId);
            $expiration = now()->addDays($pricing->duration);
        }

        $subscription = Subscription::create([
            'transaction_id' => $transactionId,
            'amount' => $transactionAmount,
            'expiration_date' => $expiration,
            'pricing_id' => $transactionPricingId,
            'room_id' => $transactionRoomId,
            'user_id' => $transactionUserId,
        ]);

        // update user is_subscribed
        $customer = User::find($transactionUserId);
        $customer->update([
            'is_subscribed' => true,
        ]);
        
        return $subscription;
        // DB::commit();
    }

    /**
     * 
     */
    public function show($id)
    {
        try {
            return view('site.private.subscription.show', [
                "subscription" => Subscription::findOrFail($id)
            ]);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
