<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    //
    use AuthorizesRequests;
    public function index(){
        return Movie::with('actors','directors','ratings','genres')->get();       
    }
    public function getMovie($id){
        
        $movie = Movie::with('actors','directors','ratings','genres')->find($id);
        return response()->json($movie, 201);
    }
    public function getDirector($id){
        
        $director = Director::with('movies')->find($id);
        return response()->json($director, 201);
    }
    public function getActor($id){
        
        $actor = Genre::with('genres')->find($id);
        return response()->json($actor, 201);
    }
    public function getGenre($id){

        $genre = Genre::with('movies')->find($id);
        return response()->json($genre, 201);
    }
    public function getMovieRatings(){
        $ratings = Rating::with('reviewer')->get();
        // $movies = Movie::with('ratings')->get();
        // $array=[];
        // foreach($movies as $movie){
        //     if($movie->ratings()!= null){
        //         array_push($array,$movie);
        //     }
        // }
        return response()->json($ratings, 201);
    }

    public function store(){
       
    }
}
