<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    protected $fillable = [
        'name',
        'start time',
        'duration',
        'description',
        'category_id',
    ];
}
