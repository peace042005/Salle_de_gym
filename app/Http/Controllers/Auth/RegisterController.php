<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone_number' => 'required|string|unique:users',
                'birth_date' => 'required|date',
                'password' => 'required|confirmed',
            ],
            [
                'first_name.required' => 'Veuillez entrer votre nom',
                'first_name.max' => 'Votre nom ne doit pas dépassé 255 caractère',

                'last_name.required' => 'Veuillez entrer votre prénom',
                'last_name.max' => 'Votre prénom ne doit pas dépassé 255 caractère',

                'email.required' => 'Veuillez entrer votre mail',
                'email.email' => 'Votre adresse mail n\'est pas valide',
                'email.max' => 'Vodre adresse mail ne doit pas dépassé 255 caractère',
                'email.unique' => 'Votre adresse mail n\'est pas disponible',

                'phone_number.required' => 'Veuillez entrer votre téléphone',
                'phone_number.unique' => 'Votre numéros n\'est pas disponible',

                'birth_date.required' => 'Veuillez entrer votre date de naissance',

                'password.required' => 'Veuillez saisir votre mot de passe ',
                'password.confirmed' => 'La confirmation du mot de passe est incorrect',
            ]
        );

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'birth_date' => $validatedData['birth_date'],
            'password' => bcrypt($validatedData['password'])
        ]);

        event(new Registered($user));
        
        // redirect to login page
        return redirect()->route('login');
    }
}
