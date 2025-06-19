<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $guarded =[];
    public $timestamps = false;
    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}
