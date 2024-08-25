<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
//defining the movies and ratings routes
Route::apiResource('movies', MovieController::class);

Route::apiResource('ratings', RatingController::class);
