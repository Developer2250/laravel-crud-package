<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $fillable = ['name', 'email', 'password', 'gender', 'posts_count', 'comments_count'];


    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    //
}
