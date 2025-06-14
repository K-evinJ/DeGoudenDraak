<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DishType extends Model
{
    protected $primaryKey = 'type';
    public $incrementing = false;
    protected $keyType = 'string';

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }
}
