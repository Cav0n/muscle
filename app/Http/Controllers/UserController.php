<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /** Register a new user. */
    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        $user = User::create($request->toArray());

        Auth::login($user);

        return redirect(route('home'))
            ->withSuccess("Votre compte a été créé avec succès.");
    }
}
