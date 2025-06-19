<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Employee;
use Illuminate\Http\Request;

class ShiftController
{
    public function index(Request $request)
    {
        $tables = Table::all();
        $employees = Employee::all();

        $selectedTableId = $request->get('table_id');
        $selectedTable = null;
        $planning = collect();

        if ($selectedTableId) {
            $selectedTable = Table::findOrFail($selectedTableId);
            $planning = $selectedTable->employees()
                ->whereBetween('pivot.date', [now()->startOfWeek(), now()->endOfWeek()])
                ->orderBy('pivot.date')
                ->get();
        }

        return view('planning.index', compact('tables', 'employees', 'selectedTable', 'planning'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_id' => 'required|exists:tables,id',
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        Table::findOrFail($validated['table_id'])->employees()->attach($validated['employee_id'], [
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);

        return redirect()->route('planning.index', ['table_id' => $validated['table_id']])
            ->with('success', 'Medewerker ingepland!');
    }
}
