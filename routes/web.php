<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/login', [AuthController::class, 'index'])->name('login');