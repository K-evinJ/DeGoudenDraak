<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CashRegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cash', function () {
    return view('EmployeeViews/CashRegister');
});
Route::post('/employee/checkout', [CashRegisterController::class, 'store'])->name('employee.checkout');
