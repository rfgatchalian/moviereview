<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMovieRequest;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Genre;
use App\Models\Movie;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MovieController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('movie_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $movies = Movie::with(['genres', 'media'])->get();

        return view('admin.movies.index', compact('movies'));
    }

    public function create()
    {
        abort_if(Gate::denies('movie_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $genres = Genre::pluck('genre_name', 'id');

        return view('admin.movies.create', compact('genres'));
    }

    public function store(StoreMovieRequest $request)
    {
        $movie = Movie::create($request->all());
        $movie->genres()->sync($request->input('genres', []));
        if ($request->input('poster', false)) {
            $movie->addMedia(storage_path('tmp/uploads/' . basename($request->input('poster'))))->toMediaCollection('poster');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $movie->id]);
        }

        return redirect()->route('admin.movies.index');
    }

    public function edit(Movie $movie)
    {
        abort_if(Gate::denies('movie_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $genres = Genre::pluck('genre_name', 'id');

        $movie->load('genres');

        return view('admin.movies.edit', compact('genres', 'movie'));
    }

    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $movie->update($request->all());
        $movie->genres()->sync($request->input('genres', []));
        if ($request->input('poster', false)) {
            if (! $movie->poster || $request->input('poster') !== $movie->poster->file_name) {
                if ($movie->poster) {
                    $movie->poster->delete();
                }
                $movie->addMedia(storage_path('tmp/uploads/' . basename($request->input('poster'))))->toMediaCollection('poster');
            }
        } elseif ($movie->poster) {
            $movie->poster->delete();
        }

        return redirect()->route('admin.movies.index');
    }

    public function show(Movie $movie)
    {
        abort_if(Gate::denies('movie_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $movie->load('genres', 'movieRatings');

        return view('admin.movies.show', compact('movie'));
    }

    public function destroy(Movie $movie)
    {
        abort_if(Gate::denies('movie_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $movie->delete();

        return back();
    }

    public function massDestroy(MassDestroyMovieRequest $request)
    {
        $movies = Movie::find(request('ids'));

        foreach ($movies as $movie) {
            $movie->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('movie_create') && Gate::denies('movie_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Movie();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
