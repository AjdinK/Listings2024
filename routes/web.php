<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;

Route::get('/', [ListingController::class, 'index'])
    ->name('home');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/profile', [ProfileController::class, 'updatePassword'])
        ->name('profile.password');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});
// Listings Route
Route::resource('listing', ListingController::class)
->except('index');

//Admin Route
Route::middleware(['auth','verified', Admin::class])
->controller(AdminController::class)
->group(function () {

    Route::get('/admin', 'index')->name('admin.index');

});


//Auth Route
require __DIR__.'/auth.php';
