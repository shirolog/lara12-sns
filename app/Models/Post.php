<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [

        'title',
        'content',
        'user_id',
    ];

    //commentsとのリレーション関係

    public function comments() {

        return $this->hasMany(Comment::class);
    }

    //userとのリレーション関係
    public function user() {
        return $this->belongsTo(User::class);
    }

    //likesとのリレーション関係
     
    public function likes() {

        return $this->hasMany(Like::class);
    }
}
