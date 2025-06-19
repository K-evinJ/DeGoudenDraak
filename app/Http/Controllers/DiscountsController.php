<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;

class DiscountsController
{
    public function index(){
        $dishes = Dish::where('visible', true)->get();
        $groupedDishes = $dishes->groupBy('dish_type')->filter()->sortKeys();
        return view('EmployeeViews.Discounts', compact('groupedDishes')); 
    }
}