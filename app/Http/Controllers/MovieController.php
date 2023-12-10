<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Movie,Rating};
use Illuminate\Support\Facades\Storage;
use Log;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('movie');
    }

    public function searchFunction(){
        $movies = Movie::orderBy('id','desc')->where(function ($query) { if(request()->search != 'null') $query->where('title','like','%'.request()->search.'%'); })->get();

        $html = '';
        if($movies->count() > 0){
            foreach($movies as $movie)
            $html .= '<a class="text-dark" href="'.route('user.getMoviesShow',$movie->id).'"><div class="suggest">' . $movie->title . '</div></a>';

        }
        else{
            $html .= '<div class="suggest">No movie title found.</div>';
        }

        return $html;
    }

    public function getMovies(){

        $movies = Movie::orderBy('title','asc')->where(function ($query) { if (request()->search != 'null') $query->where('title','like','%'.request()->search.'%'); })->get();

        $html = '';
        foreach($movies as $movie){
            $html .= ' <div class="custom-card">
            <div class="card-img-container"><a href="'.route('user.getMoviesShow', $movie->id).'"><img src="'.Storage::disk('public')->url($movie->file).'"
                        class="card-img-top"></a></div>
            <h3 class="movie-title"><a href="#" data-movie-id="4">'.$movie->title.'</a></h3>
            <p class="card-text">'.$movie->description.'</p>
        </div>';
        }

        return response()->json(['html' => $html,$movies]);

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $movieid = $id;
        $movie = Movie::findOrFail($id);

        $ratings = Rating::with(['user'])->where('movie_id',$movie->id)->orderBy('id','desc')->get();
        $average = number_format($ratings->avg('rate'),1);
        $ratings;
        return view('movieshow',compact('movieid','movie','average','ratings'));
    }

    public function submitReview(Request $request){

        $rating = new Rating();
        $rating->movie_id = $request->movie_id;
        $rating->user_id = auth()->id();
        $rating->rate = $request->rating_data ?? 1;
        $rating->review = $request->user_review;
        $rating->save();
        return response()->json(['data' => $rating]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
