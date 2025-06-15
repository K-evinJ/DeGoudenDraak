<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dish extends Model
{
    use HasFactory;

    protected $guarded =[];
    public $timestamps = false;

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

    public function getFullNumberAttribute()
    {
        return ($this->number ?? '') . ($this->menu_addition ?? '');
    }

    public function getCurrentPriceAttribute()
    {
        if ($this->discount) {
            $discountAmount = $this->price * ($this->discount / 100);
            return round($this->price - $discountAmount, 2);
        }

        return $this->price;
    }
}
