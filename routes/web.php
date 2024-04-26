<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ExerciceController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/','pages.homepage')->name('homepage');

Route::middleware('guest')->group(function () {
    Route::view('/connexion', 'pages.auth.login')->name('login');
    Route::post('/connexion', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::view('/inscription', 'pages.auth.register')->name('registration');
    Route::post('/inscription', [UserController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::view('/dashboard', 'pages.dashboard.homepage')->name('home');

    Route::prefix('/dashboard')->name('dashboard.')->group(function () {
        Route::prefix('/exercies')
            ->name('exercices.')
            ->controller(ExerciceController::class)
            ->group(function () {

                Route::get('/', 'index')->name('index');
                Route::get('/new', 'create')->name('create');
                Route::post('/new', 'store')->name('store');
                Route::get('/{exercice}', 'edit')->name('edit');
                Route::post('/{exercice}', 'update')->name('update');
                Route::delete('/{exercice}', 'destroy')->name('destroy');
        });

        Route::prefix('/seances')
            ->name('seances.')
            ->controller(SeanceController::class)
            ->group(function () {

                Route::get('/', 'index')->name('index');
                Route::get('/new', 'create')->name('create');
                Route::post('/new', 'store')->name('store');
                Route::get('/{exercice}', 'edit')->name('edit');
                Route::post('/{exercice}', 'update')->name('update');
                Route::delete('/{exercice}', 'destroy')->name('destroy');
        });
    });
});
