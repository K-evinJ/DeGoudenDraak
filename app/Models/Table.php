<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_planning')->withPivot(['date', 'start_time', 'end_time']);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
