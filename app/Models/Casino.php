<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Casino extends Model
{
    protected $fillable = [
        'banner_title',
        'title',
        'description',
        'rating',
        'url',
        'img',
        'status',
        'likes',
        'views'
    ];
}
