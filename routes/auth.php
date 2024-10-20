<?php

use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    //Register routes
    Route::get('/register', [RegisterController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'store']);

    //Login routes
    Route::get('/login', [AuthenticateController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticateController::class, 'store']);

    //forgot password routes
    Route::get('/forgot-password', [ResetPasswordController::class, 'create'])
        ->name('password.request');

    Route::post("/forgot-password", [ResetPasswordController::class, 'sendEmail'])
        ->name('password.email');

    //reset password routes
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetForm'])
        ->name("password.reset");

    Route::post('/reset-password', [ResetPasswordController::class, 'resetHandler'])
        ->name('password.update');

});

Route::middleware('auth')->group(function () {

    //logout routes
    Route::post('/logout', [AuthenticateController::class, 'destroy'])
        ->name('logout');

    //email verification routes
    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
        ->name('verification.notice');

    Route::get('email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Password Confirmation Routes
    Route::get('/confirm-password', [ConfirmPasswordController::class, 'create'])
        ->name('password.confirm');

    Route::post('/confirm-password', [ConfirmPasswordController::class, 'store'])
        ->middleware('throttle:6,1');


});
