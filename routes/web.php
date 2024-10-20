<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home')
    ->middleware('verified')
    ->name('home');


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['verified', 'password.confirm'])
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->middleware(['verified', 'password.confirm'])
        ->name('profile.edit');

});


require __DIR__.'/auth.php';