<?php

namespace App\Http\Controllers\Site\Private\User;

use App\Http\Controllers\Controller;
use App\Services\FedapayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function home() {
        $user = Auth::user();

        // execute the fedapay callback action
        $fedapayService = new FedapayService();
        $subscription = $fedapayService->useCheckout();

        // update user role to "manager"
        if($subscription == 'isManager') {
            // $user->role = 'manager';
            // $user->save();

            $user->update([
                'role' => 'manager',
            ]);

            return redirect()->route('manager.dashboad');
        }


        return view('site.private.dashboad.user.home', [
            'purchasesList' => $user->purchases,
            'roomSubscriptionList' => $user->roomSubscriptions,
            // 'becomeManagerSubscriptionList' => $user->becomeManagerSubscriptions,
        ]);
    }
}
