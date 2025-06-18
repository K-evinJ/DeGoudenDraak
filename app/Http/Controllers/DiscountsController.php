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
}