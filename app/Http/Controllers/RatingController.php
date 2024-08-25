<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Services\RatingService;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    protected $ratingService;

    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    public function index(Request $request)
    {
                //returning all the rating of the movies submited
        $ratings = $this->ratingService->getRatings($request);
        return response()->json($ratings, 200);
    }

    public function store(Request $request)
    {
                //check the data submited before the response is created

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'movie_id' => 'required|exists:movies,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);
                //make a response with validated data 


        $rating = $this->ratingService->createRating($validated);
        return response()->json($rating, 201);
        //retrun the response
    }

    public function show($id)
    {
        $rating = Rating::findOrFail($id);
        return response()->json($rating, 200);
        //return a specifice rating
    }

    public function update(Request $request,Rating $rating)
    {
                //check the data before the response created

        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'movie_id' => 'sometimes|exists:movies,id',
            'rating' => 'sometimes|integer|min:1|max:5',
            'review' => 'sometimes|string',
        ]);
                //aggrigate the data to the response 


        $rating = Rating::findOrFail($rating->id);
        $rating = $this->ratingService->updateRating($rating, $validated);
        return response()->json($rating, 200);
    }

    public function destroy(Rating $rating)
    {
        //passing the whole object then finding it's attribut using -> operation
        $rating = Rating::findOrFail($rating->id);
        $this->ratingService->deleteRating($rating);
        return response()->json(null, 204);
    }
}
