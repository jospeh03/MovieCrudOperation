<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    // Fillable property to allow mass assignment
    protected $fillable = [
        'title',
        'director',
        'genre',
        'release_year',
        'description',
    ];
    public function scopeBygenre($query, $genre)   {
        return $query->where('gener', $genre);
    }

    // Define a one-to-many relationship with the Rating model
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

}