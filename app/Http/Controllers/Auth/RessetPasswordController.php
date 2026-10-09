<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RessetPasswordController extends Controller
{
    public function index() {
        return view( 'resset-password');
    }


    public function store(Request $request )  {
        dd('mot de passe modifié avec succès');
    }
}