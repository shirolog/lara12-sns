<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{   
    use HasFactory;

    protected $fillable = [

        'post_id',
        'user_id',
        'content',
    ];

    //postとのリレーション関係
    public function post() {

        $this->belongsTo(Post::class);
    }

    //userとのリレーション関係
    public function user() {

      return $this->belongsTo(User::class);
    }
}
