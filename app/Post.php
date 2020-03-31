<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'image',
        'title',
        'body',
        'slug',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function tags()
    {
        return $this->belongsTo('App\Tag');
    }

}
