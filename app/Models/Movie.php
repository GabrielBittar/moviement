<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'tmdb_id', 'poster_path'];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_movie_watchlist')
                    ->withPivot('watched')
                    ->withTimestamps();
    }
}
