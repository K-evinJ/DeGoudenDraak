<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Table;
use App\Models\Planning;
use Carbon\Carbon;

class PlanningController extends Controller
{
    public function index(Request $request)
    {
        $tables = \App\Models\Table::all();
        $selectedTableId = $request->get('table_id', $tables->first()?->id);
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $table = Table::with(['employees' => function ($query) use ($startOfWeek, $endOfWeek) {
            $query->whereBetween('employee_planning.date', [
                $startOfWeek->toDateString(),
                $endOfWeek->toDateString(),
            ]);
        }])->find($selectedTableId);

        $employees = \App\Models\Employee::all();

        return view('EmployeeViews.employeePlanning', compact('tables', 'table', 'employees', 'startOfWeek'));
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

        $table = \App\Models\Table::findOrFail($validated['table_id']);
        $table->employees()->attach($validated['employee_id'], [
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);

        return back()->with('message', 'Planning toegevoegd!');
    }
}
