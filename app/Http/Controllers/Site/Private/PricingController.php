<?php

namespace App\Http\Controllers\Site\Private;

use App\Http\Controllers\Controller;
use App\Models\Pricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PricingController extends Controller
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
    public function index(Request $request) {
        // get the search field value
        $search = $request->input('search');

        // do filtering
        if (isset($search)) {
            $pricingList = Pricing::where('name', 'like', '%' . $search . '%')
                ->orWhere('duration', 'like', '%' . $search . '%')
                ->orWhere('price', 'like', '%' . $search . '%')
                ->orderBy('id', 'desc')
                ->paginate();
        } else {
            $pricingList = Pricing::orderBy('id', 'desc')->paginate(9);
        }
        
        return view('site.private.pricing.index', [
            'pricingList' => $pricingList,
        ]);
    }
    
    /**
     * 
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'duration' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        // dd($validatedData);
        try {
            if($this->authenticatedUser->role == "admin") {
                Pricing::create([
                    'name' => $validatedData['name'],
                    'duration' => $validatedData['duration'],
                    'price' => $validatedData['price'],
                    'user_id' => Auth::user()->id,
                ]);

                toast( "Nouvel type d'abonnement ajouté avec succes", 'success');
            }

            return redirect()->back();
        } catch (\Exception $e) {
            // Handle transaction failure
        }
    }
    
    /**
     * 
     */
    public function show($id)
    {
        $pricing = Pricing::find($id);
        
        return view('site.private.pricing.show', [
            'pricing' => $pricing
        ]);
    }

    /**
     * 
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'duration' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        // dd($validatedData);
        try {
            if($this->authenticatedUser->role == "admin") {
                $pricing = Pricing::find($id);

                $pricing->update([
                    'name' => $validatedData['name'],
                    'duration' => $validatedData['duration'],
                    'price' => $validatedData['price'],
                ]);
        
                toast( "Type d'abonnement modifié avec succes", 'success');
            }

            return redirect()->back();
        } catch (\Exception $e) {
            // Handle transaction failure
        }
    }
    
    /**
     * 
     */
    public function destroy($id)
    {
        try {
            if($this->authenticatedUser->role == "admin") {
                $pricing = Pricing::find($id);
                $pricing->delete();
                
                toast( "Type d'abonnement supprimé avec succes", 'success');
            }
            
            return redirect()->back();
        } catch (\Exception $e) {
            // Handle transaction failure
        }
    }
}
