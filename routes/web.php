<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CashRegisterController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cash', function () {
    return view('EmployeeViews/CashRegister');
});
Route::post('/employee/checkout', [CashRegisterController::class, 'store'])->name('employee.checkout');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
