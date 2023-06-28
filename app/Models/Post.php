<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'location',
        'description',
        'filename',
        'likes',
        'status',
    ];

    public function getFileNameAttribute($val)
    {
        return getFile($val);
    }
}
