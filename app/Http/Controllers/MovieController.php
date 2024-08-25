<?php
namespace App\Http\Controllers;

use App\Models\Movie;
use App\Services\MovieService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index(Request $request)
    {
        $movies = Movie::all();
         return response()->json($movies, 200);
        // $genre = $request->query('genre');
        // Filtering
        // $movies=Movie::bygenre($genre)->get();
        // if ($request->has('director')) {
        //     $movies->where('director', $request->director);
        // }

        // // Sorting
        // if ($request->has('sort')) {
        //     $movies->orderBy('release_year', $request->sort);
        // }

        // // Pagination
        // return $movies->paginate($request->get('per_page', 10));
    }

    public function store(Request $request)
    {
        //validate the data before the request submition
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'release_year' => 'required|integer',
            'description' => 'nullable|string',
        ]);
        //submite the validated data through the services method to the object i had created
        $movie = $this->movieService->createMovie($validatedData);
        
        return response()->json($movie, 201);
        //return the object that was created
    }

    public function show($id)
    {
        $movie = movie::findOrFail($id);

        return response()->json($movie);
        //show a specfiec object of kind movie
    }

    public function update(Request $request, Movie $movie)
    {
                //validate the data before the request submition
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'director' => 'sometimes|required|string|max:255',
            'genre' => 'sometimes|required|string|max:255',
            'release_year' => 'sometimes|required|integer',
            'description' => 'nullable|string',
        ]);
        //submite the validated data through the services method to the object i had created
        $updatedMovie = $this->movieService->updateMovie($movie, $validatedData);

        return response()->json($updatedMovie);
        //return the updated object with movie type
    }

    public function destroy(Movie $movie)
    {
        $this->movieService->deleteMovie($movie);

        return response()->json(null, 204);
    }
}
