<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Movie};
use Illuminate\Support\Facades\Storage;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admins.movie');

    }

    public function searchFunction(){
        $movies = Movie::orderBy('id','desc')->where(function ($query) { if(request()->search != 'null') $query->where('title','like','%'.request()->search.'%'); })->get();

        $html = '';
        if($movies->count() > 0){
            foreach($movies as $movie)
            $html .= '<div class="suggest">' . $movie->title . '</div>';

        }
        else{
            $html .= '<div class="suggest">No movie title found.</div>';
        }

        return $html;
    }
    public function getMovies(){


        $movies = Movie::orderBy('id','desc')->where(function ($query) { if(request()->search != 'null') $query->where('title','like','%'.request()->search.'%'); })->get();

        $html = '<table class="table table-bordered table-striped">';

        $html .= ' <thead>
                    <tr>
                        <th style="background-color: #ffbd59; text-align: center;">Image</th>
                        <th style="background-color: #ffbd59; text-align: center;">Title</th>
                        <th style="background-color: #ffbd59; text-align: center;">Genre</th>
                        <th style="background-color: #ffbd59; text-align: center;">Director</th>
                        <th style="background-color: #ffbd59; text-align: center;">Main Cast</th>
                        <th style="background-color: #ffbd59; text-align: center;" >Description</th>
                        <th style="background-color: #ffbd59; text-align: center;">Trailer</th>
                        <th style="background-color: #ffbd59; text-align: center;">Actions
                        </th>
                    </tr>
                </thead>';
        $html .= '<tbody>';

        foreach($movies as $movie){
            $html .= '<tr>
            <td><img src="'.Storage::disk('public')->url($movie->file).'" class="img-thumbnail"
                    width="50" height="35"></td>
            <td>'.$movie->title.'</td>
            <td>'.$movie->genres.'</td>
            <td>'.$movie->director.'</td>
            <td>'.$movie->cast.'</td>
            <td style="text-align:justify">'.$movie->description.'
            </td>
            <td>'.$movie->trailer.'</td>
            <td><button type="button" name="update" id="65"
                    class="update btn btn-success btn-md update"
                    style="padding: 10px; margin: 8px 0; width: 100%;" data-bs-toggle="modal" data-bs-target="#updateModal'.$movie->id.'" id="updateModal'.$movie->id.'">Update</button>
                <button type="button" name="delete" id="65" class="btn btn-danger btn-md delete"
                    style="padding: 10px; margin: 8px 0; width: 100%;" onclick="deleteData('.$movie->id.')">Delete</button>
            </td>
        </tr>';
        }

        $html .= '</tbody>';

        $html .= '</table>';


        $modalhtml = '';
        foreach($movies as $movie){

        $modalhtml .= '<div class="modal fade" id="updateModal'.$movie->id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 80px;">
            <div class="modal-content">
                <form id="update_user_form'.$movie->id.'">

                    <div class="modal-header">
                        <h5 class="modal-title" style="font-weight: bold">Edit Movie</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="movieid" value="'.$movie->id.'" id="movieid">
                        <label>Title</label>
                        <input type="text" name="title" id="title" class="form-control" required="" value="'.$movie->title.'">

                        <label>Genre</label>
                        <input type="text" name="genres" id="genres" class="form-control" required="" value="'.$movie->genres.'">

                        <label>Director</label>
                        <input type="text" name="director" id="director" class="form-control" required="" value="'.$movie->director.'">

                        <label>Main Cast</label>
                        <input type="text" name="cast" id="cast" class="form-control" required="" value="'.$movie->cast.'">

                        <label>Description</label>
                        <textarea name="description" id="description" class="form-control" style="width: 100%; height:auto" required="">'.$movie->description.'</textarea>

                        <label>Trailer</label>
                        <input type="text" name="trailer" id="trailer" class="form-control" required="" value="'.$movie->trailer.'">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="updateData('.$movie->id.')">Update</button>

                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>';
    }

        return response()->json(['data' => $html, 'updatemodal' => $modalhtml]);
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

        $path = $request->file('file')->store('uploads', 'public');

        // Generate the full URL for the stored file
        $fileUrl = Storage::disk('public')->url($path);

        $movie = new Movie();
        $movie->title = $request->title;
        $movie->cast = $request->cast;
        $movie->description= $request->description;
        $movie->trailer =$request->trailer;
        $movie->director= $request->director;
        $movie->file= $path;
        $movie->genres= $request->genres;
        $movie->save();
        return response()->json(['data' => $movie]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request)
    {
        //



        $movie = Movie::find(request()->movieid);
        $movie->title = $request->title;
        $movie->cast = $request->cast;
        $movie->description= $request->description;
        $movie->trailer =$request->trailer;
        $movie->director= $request->director;
        //$movie->file= $path;
        $movie->genres= $request->genres;
        $movie->save();

        return response()->json(['data' => $movie]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $movie = Movie::find($request->id);
        $movie->delete();

        return response()->json(['data' => 'success']);
    }
}
