<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function index()
    {
        // if (Auth::check())
        // {
        //     return redirect()->route()
        // }

        return view('employeeViews.login');
    }

    public function authenticate(Request $request)
    {
        return redirect()->back()->with('login_error', 'Medewerker nummer of wachtwoord onjuist.');
        // Validate input
        $credentials = $request->validate([
            'employeeNr' => 'required|integer|min:1',
            'password' => 'required|string',
        ]);

        // Find employee by employeeNr
        $employee = Employee::where('employeeNr', $credentials['employeeNr'])->first();

        if (!$employee || !Hash::check($credentials['password'], $employee->password)) {
            return back()->with('login_error', 'Ongeldig medewerker nummer of wachtwoord.');
        }

        // Log in the user using a custom guard if applicable, or manually
        Auth::login($employee);

        return redirect()->intended('/employee/dashboard'); // Change to your desired route
    }
}