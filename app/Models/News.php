<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'date';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'date' => 'date',
    ];
}
