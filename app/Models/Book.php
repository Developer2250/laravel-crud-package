<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $fillable = ['title', 'author_id', 'published_date', 'isbn', 'summary'];

    protected $casts = [
        'published_date' => 'date'
    ];


    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    //
}
