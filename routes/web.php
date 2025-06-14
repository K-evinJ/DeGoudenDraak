<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CashRegisterController;
use App\Http\Controllers\AuthController;
use Illuminate\Auth\Middleware\Authenticate;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');

Route::middleware([Authenticate::class])->group(function () {
    Route::get('/cash', [CashRegisterController::class, 'index'])->name('employee.cashRegister');
    Route::post('/employee/checkout', [CashRegisterController::class, 'store'])->name('employee.checkout');
});
