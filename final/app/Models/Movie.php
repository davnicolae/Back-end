<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Movie extends Model  {
    protected $fillable = ['title','release_date', 'description', 'genre_type','trailer'];

    public function actors() {
        return $this->belongsToMany(Actor::class);
    }
}

