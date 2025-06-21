<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $guarded = [];
    public $timestamps = false;
    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'order_lines')->withPivot(['amount', 'original_dishprice', 'extra_information']);
    }
}
