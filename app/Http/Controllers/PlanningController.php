<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Table;
use App\Models\Planning;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PlanningController extends Controller
{
    public function index(Request $request)
    {
        $tables = \App\Models\Table::all();
        $selectedTableId = $request->get('table_id', $tables->first()?->id);
        $startDate = Carbon::now()->startOfDay();
        $endDate = $startDate->copy()->addDays(6); 

        $table = Table::with(['employees' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('employee_planning.date', [$startDate, $endDate]);
        }])->find($selectedTableId);

        $employees = \App\Models\Employee::all();

        return view('EmployeeViews.employeePlanning', compact('tables', 'table', 'employees', 'startDate'));
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

    public function employeePlanning()
    {
        $employee = Auth::user();
        $startDate = Carbon::now()->startOfDay();
        $endDate = $startDate->copy()->addDays(6);

        // Get all planning within 7 days
        $tables = $employee->tables()
            ->wherePivotBetween('date', [$startDate->toDateString(), $endDate->toDateString()])
            ->withPivot('date', 'start_time', 'end_time')
            ->get()
            ->groupBy(fn ($table) => $table->pivot->date);

        return view('EmployeeViews.employeePlanningView', compact('tables', 'startDate'));
    }
}
