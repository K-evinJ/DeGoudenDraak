<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use App\Models\Dish;
use Illuminate\Support\Facades\DB;

class DiscountsController
{
    public function index(){
        Discount::where('end_date', '<', now())->delete();
        $dishes = Dish::where('visible', true)->get();
        $groupedDishes = $dishes->groupBy('dish_type')->filter()->sortKeys();

        $discounts = DB::table('discounts')
        ->join('dishes', 'discounts.dish_id', '=', 'dishes.id')
        ->select('discounts.*', 'dishes.name')
        ->get();
        return view('EmployeeViews.Discounts', compact('groupedDishes','discounts')); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dish_id' => 'required|exists:dishes,id',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
        ]);

        if($validated['endDate'] < $validated['startDate']){
            return redirect()->back()->with('message', 'Einddatum moet na de begindatum liggen.');
        }

        if($validated['endDate'] < now()){
            return redirect()->back()->with('message', 'Aanbieding al verlopen.');
        }

        if(sizeof(Discount::where('dish_id', $validated['dish_id'])->get()) > 0){
            return redirect()->back()->with('message', 'Gerecht heeft al een aanbieding.');
        }

        Discount::Create(
            [
                'dish_id' => $validated['dish_id'],
                'discount_percentage' => $validated['discount_percentage'],
                'start_date' => $validated['startDate'],
                'end_date' => $validated['endDate'],
            ]
            );

        return redirect()->back()->with('message', 'Aanbieding succesvol opgeslagen.');
    }
}