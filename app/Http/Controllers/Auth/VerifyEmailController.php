<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function verify(Request $request, $id)
    {
        if (!$request->hasValidSignature()) {
            return response()->json(['msg' => 'Invalid/Expired url provided.'], 401);
        }

        $user = User::findOrFail($id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return redirect()->route('login');
    }

    
    public function resend($id)
    {
        $user = User::findOrFail($id);

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email already verified.',
            ], 400);
        }

        $user->sendEmailVerificationNotification();

        return response()->route('login');
    }
}
