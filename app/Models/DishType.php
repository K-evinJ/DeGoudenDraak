<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishType extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'type';
    public $incrementing = false;
    protected $keyType = 'string';

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }
}
