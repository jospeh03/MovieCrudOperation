<?php

namespace App\Services;

use App\Models\Rating;

class RatingService
{
    public function getRatings($request)
    {
        $ratings = Rating::query();

        // Filtering by movie_id
        if ($movieId = $request->query('movie_id')) {
            $ratings->where('movie_id', $movieId);
        }

        // Filtering by user_id
        if ($userId = $request->query('user_id')) {
            $ratings->where('user_id', $userId);
        }

        // Sorting
        if ($sort = $request->query('sort')) {
            $ratings->orderBy('created_at', $sort);
        }

        // Pagination
        return $ratings->paginate($request->query('per_page', 10));
    }

    public function createRating($data)
    {
        return Rating::create($data);
    }

    public function updateRating(Rating $rating, $data)
    {
        $rating->update($data);
        return $rating;
    }

    public function deleteRating(Rating $rating)
    {
        $rating->delete();
    }
}
