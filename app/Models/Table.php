<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function employees()
    {
        return $this->belongsToMany(Employee::class)->withPivot(['date', 'start_time', 'end_time']);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
