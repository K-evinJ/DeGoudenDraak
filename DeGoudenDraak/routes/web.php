<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/env', function () {
    return [
        'env' => env('APP_ENV'),
        'db' => env('DB_DATABASE'),
    ];
});
