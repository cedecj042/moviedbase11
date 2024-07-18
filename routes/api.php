<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MoviesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',[AuthController::class,'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('movies', [MoviesController::class,'index']);
    Route::get('movie/{id}',[MoviesController::class,'getMovie']);
    Route::get('director/{id}',[MoviesController::class,'getDirector']);
    Route::get('actor/{id}',[MoviesController::class,'getActor']);
    Route::get('genre/{id}',[MoviesController::class,'getGenre']);
    Route::get('movieRatings',[MoviesController::class,'getMovieRatings']);
});