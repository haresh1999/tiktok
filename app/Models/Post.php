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
        'type',
        'html',
        'user_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id')->select('id','name','profile_image');
    }

    public function getFileNameAttribute($val)
    {
        return getFile($val);
    }
}
