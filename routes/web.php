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
    Route::get('/cashRegister', [CashRegisterController::class, 'index'])->name('employee.cashRegister');
    Route::post('/storeOrder',[CashRegisterController::class, 'store'])->name('orderCashregister');
    Route::post('/logout', [AuthController::class, 'logoutUser'])->name('logout');
});
