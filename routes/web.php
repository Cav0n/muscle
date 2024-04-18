<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::view('/','pages.homepage')->name('homepage');

Route::middleware('guest')->group(function () {
    Route::view('/connexion', 'pages.auth.login')->name('login');
    Route::post('/connexion', [AuthController::class, 'authenticate'])->name('authenticate');
});

Route::middleware('auth')->group(function () {
    Route::view('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::view('/dashboard', 'pages.dashboard.homepage')->name('home');
});
