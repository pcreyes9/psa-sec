<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('employees', 'employees')
    ->middleware(['auth', 'verified'])
    ->name('employees');

Route::view('payroll', 'payroll')
    ->middleware(['auth', 'verified'])
    ->name('payroll');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
