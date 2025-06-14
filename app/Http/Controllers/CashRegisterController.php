<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Dish;
use Carbon\Carbon;

class CashRegisterController
{
    public function index(){
        $dishes = Dish::where('visible', true)->get();
        $groupedDishes = $dishes->groupBy('dish_type')->filter()->sortKeys();
        return view('EmployeeViews.CashRegister', compact('groupedDishes'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dishes' => 'required|array|min:1',
        ]);

        $order = Order::create([
            'is_paid' => true,
            'is_delivered' => false,
            'moment' => Carbon::now(),
        ]);

        $attachData = [];

    foreach ($validated['dishes'] as $dishId => $quantity) {
        if($quantity > 0){
            $dish = \App\Models\Dish::findOrFail($dishId);

            $attachData[$dishId] = [
                'amount' => $quantity,
                'original_dishprice' => $dish->current_price,
                'extra_information' => null,
            ];
        }
    }
    $order->dishes()->attach($attachData);
    
        return redirect()->route('employee.cashRegister')->with('success', 'Bestelling opgeslagen!');
    }
}