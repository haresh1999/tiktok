<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'status',
        'likes',
        'views',
        'img'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d'
    ];
}
