<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
<<<<<<< HEAD
    Route::view('/', 'attendance');
    
=======
>>>>>>> adea58223f25f520a9bee1d2707be305a36c330a
    Volt::route('login', 'pages.auth.login')
        ->name('login');

    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
    Volt::route('register', 'pages.auth.register')
        ->name('register');
});

Route::middleware('auth')->group(function () {
<<<<<<< HEAD
    // Volt::route('register', 'pages.auth.register')
    //     ->name('register');
=======
    Volt::route('register', 'pages.auth.register')
        ->name('register');
>>>>>>> adea58223f25f520a9bee1d2707be305a36c330a

    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');
});
