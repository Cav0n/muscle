<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    /** Authenticate a user. */
    public function authenticate(Request $request)
    {
        $credentials = $request->only(["email", "password"]);

        $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate();

            // Redirect user to his dashboard
            return redirect()->intended(route('homepage'));
        }

        return redirect(route('login'))
                ->withErrors([
                    'email' => __('Email ou mot de passe incorrect.'),
                ])
                ->withInput($request->toArray());
    }

    /** Logout a user. */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
