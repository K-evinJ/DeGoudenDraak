<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function index()
    {
        // if (Auth::check())
        // {
        //     return redirect()->route()
        // }

        return view('employeeViews.login');
    }
}