<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    public function index()
    {
        //will be used in a different branch
        // if (Auth::check())
        // {
        //     return redirect()->route()
        // }
        return view('employeeViews.login');
    }

    public function authenticate(Request $request)
    {
        // Validate input
        $credentials = $request->validate([
            'employeeNr' => 'required|integer|min:1',
            'password' => 'required|string',
        ]);

        // Find employee by employeeNr
        $employee = Employee::where('id', $credentials['employeeNr'])->first();

        if (!$employee || !Hash::check($credentials['password'], $employee->password)) {
            return redirect()->back()->with('login_error', 'Medewerker nummer of wachtwoord onjuist.');
        }

        // Log in the user using a custom guard if applicable, or manually
        Auth::login($employee, false);

        // return redirect()->intended('/employee/dashboard'); // Change to your desired route
        return redirect()->back()->with('login_error', 'je zit erin hoor');
    }
}