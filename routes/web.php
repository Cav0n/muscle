<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ExerciceController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\SeanceInviteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::view('/','pages.homepage')->name('homepage');

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
                Route::any('/store', 'store')->name('store');
                Route::get('/{exercice}', 'edit')->name('edit');
                Route::post('/{exercice}', 'update')->name('update');
                Route::delete('/{exercice}', 'destroy')->name('destroy');
        });

        Route::prefix('/seances')
            ->name('seances.')
            ->controller(SeanceController::class)
            ->group(function () {

                Route::prefix('/invitations')
                    ->name('invites.')
                    ->controller(SeanceInviteController::class)
                    ->group(function () {
                        Route::post('/new', 'store')->name('store');
                        Route::any('/{seanceInvite}/suppression', 'destroy')->name('destroy');
                });

                Route::get('/', 'index')->name('index');
                Route::get('/new', 'create')->name('create');
                Route::any('/store', 'store')->name('store');
                Route::get('/{seance}', 'edit')->name('edit');
                Route::post('/{seance}', 'update')->name('update');
                Route::delete('/{seance}', 'destroy')->name('destroy');

                Route::prefix('/{seance}/exercices')
                    ->name('exercices.')
                    ->group(function () {
                        Route::post('/add', 'addExerciceToSeance')->name('add');
                        Route::any('/{exercice}', 'removeExerciceFromSeance')->name('remove');
                });
        });
    });
});
