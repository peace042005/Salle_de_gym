<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function store(Request $request){
        $validated = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Veuillez entrer votre mail',
                'email.email' => 'Votre adresse mail n\'est pas valide',
                'password.required' => 'Veuillez saisir votre mot de passe ',
            ]
        );

        if (! Auth::attempt($validated)) {
            return back()->with([
                'loginErrorMessage' => 'Votre adresse mail ou votre mot de passe est incorrect'
            ]);
        } else {
            $user = User::where('email', $validated['email'])->first();

            Auth::login($user);

            if( $request->modal == "true" ) {
                return redirect()->back();
            }

            return redirect()->route('app.welcome');
        }
    }

    public function destroy() {
        Auth::logout();

        return redirect()->back();
        // return redirect()->route('app.welcome');
    }
}
