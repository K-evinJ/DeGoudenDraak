<?php

use Illuminate\Support\Facades\Route;
use CashRegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cash', function () {
    return view('EmployeeView/CashRegister');
});
Route::post('/employee/checkout', [CashRegisterController::class, 'store'])->name('employee.checkout');
