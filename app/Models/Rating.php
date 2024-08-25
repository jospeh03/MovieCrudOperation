<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
//defining the fillable according to the specification and the migration
    protected $fillable = ['user_id', 'movie_id', 'rating', 'review'];
//defining the realtionship with movie and the users Many-to one
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
