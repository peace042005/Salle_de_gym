<?php

namespace App\Http\Controllers\Site\Private\Admin;

use App\Http\Controllers\Controller;
use App\Models\Outfit;
use App\Models\Purchase;
use App\Models\Room;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{

    public function home() {
        $subscriptionsList = Subscription::get();
        $subsIds = $subscriptionsList->pluck('user_id');
        $subscribersList = User::whereIn('id', $subsIds)->get();

        $purchasersList = Purchase::get();
        $ids = $purchasersList->pluck('user_id');
        $purchasersList = User::whereIn('id', $ids)->get();

        return view('site.private.dashboad.admin.home', [
            'outfitsCount' =>  Outfit::count(),
            'roomsCount' => Room::count(),

            'subscribersCount' =>  $subscribersList->count(),
            'subscriptionsCount' => $subscriptionsList->count(),

            'purchasersCount' => $purchasersList->count(),
            'purchasesCount' => $purchasersList->count(),
        ]);
    }
}
