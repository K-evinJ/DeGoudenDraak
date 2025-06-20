<?php

namespace App\Http\Controllers;

use App\Models\Dish;

class APIController extends Controller
{
    public function dishes()
    {
        $query = Dish::where('visible', true)->get();
        $groupedDishes = $query->groupBy('dish_type')->filter()->sortKeys();
        return response()->json(['groupedDishes' => $groupedDishes]);
    }
}
