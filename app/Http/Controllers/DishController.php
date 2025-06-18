<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DishType;
use App\Models\Dish;

class DishController
{

    public function dishesPage(){
        $dishes = Dish::get();
        $groupedDishes = $dishes->groupBy('dish_type')->filter()->sortKeys();
        $dishTypes = DishType::orderBy('type')->get();
        return view('EmployeeViews.DishesCRUD', compact('groupedDishes','dishTypes'));
    }

    public function storeOrUpdate(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'dish_id' => 'nullable|exists:dishes,id',
            'description' => 'nullable|string|max:300',
            'dish_type' => 'required|exists:dish_types,type',
        ]);

        $dish = $request->dish_id ? Dish::find($request->dish_id) : new Dish();
        $dish->name = $validated['name'];
        $dish->description = $validated['description'] ?? null;
        $dish->price = $validated['price'];
        $dish->visible = $request['visible'] == 'on';
        $dish->dish_type = $validated['dish_type'];
        $dish->save();

        return redirect()->back()->with('dish_message', 'Gerecht succesvol opgeslagen.');
    }
}