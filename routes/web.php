<?php

use Illuminate\Support\Facades\Route;
use App\Exports\PayrollExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PayslipController;

// EXPORTS
Route::get(
    '/payslip/{payrollItem}',
    [PayslipController::class, 'show']
)->name('payslip.show');


Route::get(
    '/payroll/export/{month}/{cutoff}',
    [PayrollController::class, 'export']
)->name('payroll.export');

// PAGES
Route::view('/', 'attendance');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('employees', 'employees')
    ->middleware(['auth', 'verified'])
    ->name('employees');

Route::view('payroll', 'payroll-generator')
    ->middleware(['auth', 'verified'])
    ->name('payroll');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('attendance', 'employees-attendance')
    ->middleware(['auth', 'verified'])
    ->name('attendance');

Route::view('employee-payroll', 'employees-payroll')
    ->middleware(['auth', 'verified'])
    ->name('employee-payroll');

Route::view('tax-table', 'tax-bracket')
    ->middleware(['auth', 'verified'])
    ->name('tax-table');

Route::view('settings', 'settings')
    ->middleware(['auth', 'verified'])
    ->name('settings');

require __DIR__.'/auth.php';
