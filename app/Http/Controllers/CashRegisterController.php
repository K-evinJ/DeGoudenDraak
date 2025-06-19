<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Dish;
use Carbon\Carbon;
USE Barryvdh\DomPDF\Facade\Pdf;

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
    if(sizeof($attachData) == 0){
        return redirect()->route('employee.cashRegister')->with('order_message', 'Niets geselecteerd');
    }
    $order->dishes()->attach($attachData);
    
    $order->load('dishes');

    $pdf = Pdf::loadView('employeeViews.receipt', compact('order'))->setPaper([0, 0, 240, 283], 'portrait');

    return $pdf->download("Rekening_Order_{$order->id}.pdf");
    }
}