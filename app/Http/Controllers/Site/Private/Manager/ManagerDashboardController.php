<?php

namespace App\Http\Controllers\Site\Private\Manager;

use App\Http\Controllers\Controller;
use App\Models\Outfit;
use App\Models\Purchase;
use App\Models\Room;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerDashboardController extends Controller
{
    public $authenticatedUser;

    /**
     * 
     */
    public function __construct()
    {
        $this->authenticatedUser = Auth::user();
    }

    
    public function home() {
        $roomsAddByManagerID = Room::addedByManager($this->authenticatedUser->id)->pluck('id');
        $subsIds = Subscription::whereIn('room_id', $roomsAddByManagerID)->pluck('user_id');
        $subscribersList = User::with('subscriptions')->whereIn('id', $subsIds)->get();

        
        $outfitsAddByManagerID = Outfit::addedByManager($this->authenticatedUser->id)->pluck('id');
        $purchIds = Purchase::whereIn('outfit_id', $outfitsAddByManagerID)->pluck('user_id');
        $purchasersList = User::whereIn('id', $purchIds)->get();

        return view('site.private.dashboad.manager.home', [
            'outfitsCount' =>  $outfitsAddByManagerID->count(),
            'roomsCount' => $roomsAddByManagerID->count(),

            'subscribersCount' =>  $subscribersList->count(),
            'subscriptionsCount' => $subsIds->count(),

            'purchasersCount' => $purchasersList->count(),
            'purchasesCount' => $purchIds->count(),
        ]);
    }
}
