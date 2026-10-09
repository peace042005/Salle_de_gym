<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\Outfit;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
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
                // list of purchases// list of purchases
                $allOutfits = Outfit::pluck('id');
                $purchasesList = Purchase::whereIn('outfit_id', $allOutfits)->get();

                // list of purchasers
                $ids = Purchase::pluck('user_id');
                $purchasersList = User::whereIn('id', $ids)->get();
            } else {
                // list of purchases
                $outfitsAddByManagerID = Outfit::addedByManager($this->authenticatedUser->id)->pluck('id');
                $purchasesList = Purchase::whereIn('outfit_id', $outfitsAddByManagerID)->get();

                // list of purchasers
                $ids = Purchase::whereIn('outfit_id', $outfitsAddByManagerID)->pluck('user_id');
                $purchasersList = User::whereIn('id', $ids)->get();
            }

            return view('site.private.purchase.index', [
                "purchasesList" => $purchasesList,
                "purchasersList" => $purchasersList,
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
        $transactionPricing,
        $transactionOutfitId,
        $transactionUserId,
    )
    {
        // DB::beginTransaction();
        Purchase::create([
            'transaction_id' => $transactionId,
            'amount' => $transactionAmount,
            'pricing_id' => $transactionPricing,
            'outfit_id' => $transactionOutfitId,
            'user_id' => $transactionUserId,
        ]);
        // DB::commit();
    }

    /**
     * 
     */
    public function show($id)
    {
        try {
            return view('site.private.purchase.show', [
                "purchase" => Purchase::findOrFail($id)
            ]);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * 
     */
    public function update($id)
    {
        try {
            $model = Purchase::findOrFail($id);

            if ($model->status == 'pending') {
                DB::beginTransaction();
                    $model->update([
                        'status' => 'closed'
                    ]);
                DB::commit();
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
