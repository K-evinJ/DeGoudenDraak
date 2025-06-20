<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeController
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:4',
        ]);

        $employee = Employee::create([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->back()->with([
        'message' => 'Werknemer met ID: ' . $employee->id . ' aangemaakt']);
    }
}
