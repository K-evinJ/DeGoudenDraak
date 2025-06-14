<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function login()
    {
        // if (Auth::check())
        // {
        //     return redirect()->route()
        // }

        return view('employeeViews.login');
    }
}