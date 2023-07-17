<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Casino extends Model
{
    protected $fillable = [
        'name',
        'title',
        'description',
        'rating',
        'url',
        'img',
        'status',
        'top_rated',
    ];
}
