<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot(['amount', 'original_dishprice', 'extra_information']);
    }

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }

    public function type()
    {
        return $this->belongsTo(DishType::class);
    }
}
