<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    protected $fillable = ['first_name', 'last_name', 'bio'];

    protected $appends = ['full_name'];


    public function books()
    {
        return $this->hasMany(Book::class, 'author_id');
    }
    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    //
}
