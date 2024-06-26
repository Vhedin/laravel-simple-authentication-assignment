<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // user
    Route::prefix('/user')->name('user.')->group(function () {
        Route::get('/trash', [UserController::class, 'trash'])->name('trash');
        Route::post('/restore/{user}', [UserController::class, 'restore'])->name('restore');
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::get('/profile-edit', [UserController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile-edit', [UserController::class, 'updateProfile']);
        Route::resource('/', UserController::class)->parameters(['' => 'user']);
    });
});
// Guest routes
Route::group(['middleware' => 'guest'], function () {
    // Define rate limiting for the login routes
    RateLimiter::for('login', function ($request) {
        return Limit::perMinute(10)->by($request->ip());
    });

    // Routes for login
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware(['throttle:login']);
});
