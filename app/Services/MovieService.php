<?php
namespace App\Services;

use App\Models\Movie;

class MovieService
{
    //defining methods to deal with crud operation to increase the security of the application
    public function createMovie($data)
    {
        return Movie::create($data);
    }

    public function updateMovie(Movie $movie, $data)
    {
        $movie->update($data);
        return $movie;
    }

    public function deleteMovie(Movie $movie)
    {
        $movie->delete();
    }
}
