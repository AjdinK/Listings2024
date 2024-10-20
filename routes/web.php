<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home')
    ->middleware('verified')
    ->name('home');

Route::inertia('/dashboard', "Dashboard")
    ->middleware(['auth', 'verified', 'password.confirm'])
    ->name('dashboard');

Route::inertia('/profile', "Profile")
    ->middleware(['auth', 'verified', 'password.confirm'])
    ->name('profile');


require __DIR__.'/auth.php';