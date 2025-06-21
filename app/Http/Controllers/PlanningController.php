<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlanningController extends Controller
{
    public function index(Request $request)
    {
        $tables = Table::all();
        $selectedTableId = $request->get('table_id', $tables->first()?->id);
        $startDate = Carbon::now()->startOfDay();
        $endDate = $startDate->copy()->addDays(6);

        $table = Table::with(['employees' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('employee_planning.date', [$startDate, $endDate]);
        }])->find($selectedTableId);

        $employees = Employee::all();

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

        $exists = DB::table('employee_planning')
            ->where('table_id', $validated['table_id'])
            ->where('employee_id', $validated['employee_id'])
            ->where('date', $validated['date'])
            ->where('start_time', $validated['start_time'])
            ->exists();

        $overlap = DB::table('employee_planning')
            ->where('table_id', $validated['table_id'])
            ->where('employee_id', $validated['employee_id'])
            ->where('date', $validated['date'])
            ->where(function ($query) use ($validated) {
                $query
                    // New start is between existing range
                    ->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                    // OR new end is between existing range
                    ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']])
                    // OR existing start is between new range
                    ->orWhere(function ($sub) use ($validated) {
                        $sub->where('start_time', '>=', $validated['start_time'])
                            ->where('start_time', '<', $validated['end_time']);
                    })
                    // OR existing end is between new range
                    ->orWhere(function ($sub) use ($validated) {
                        $sub->where('end_time', '>', $validated['start_time'])
                            ->where('end_time', '<=', $validated['end_time']);
                    });
            })
            ->exists();

        if ($exists || $overlap) {
            return back()
                ->with(['message' => 'Deze werknemer is al gepland voor deze tafel op dit tijdstip.']);
        }

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
            ->sortBy(fn($table) => $table->pivot->start_time)
            ->groupBy(fn($table) => $table->pivot->date);

        return view('EmployeeViews.employeePlanningView', compact('tables', 'startDate'));
    }
}
