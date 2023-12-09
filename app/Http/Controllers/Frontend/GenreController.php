<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGenreRequest;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Models\Genre;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GenreController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('genre_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $genres = Genre::all();

        return view('frontend.genres.index', compact('genres'));
    }

    public function create()
    {
        abort_if(Gate::denies('genre_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.genres.create');
    }

    public function store(StoreGenreRequest $request)
    {
        $genre = Genre::create($request->all());

        return redirect()->route('frontend.genres.index');
    }

    public function edit(Genre $genre)
    {
        abort_if(Gate::denies('genre_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.genres.edit', compact('genre'));
    }

    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        $genre->update($request->all());

        return redirect()->route('frontend.genres.index');
    }

    public function show(Genre $genre)
    {
        abort_if(Gate::denies('genre_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.genres.show', compact('genre'));
    }

    public function destroy(Genre $genre)
    {
        abort_if(Gate::denies('genre_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $genre->delete();

        return back();
    }

    public function massDestroy(MassDestroyGenreRequest $request)
    {
        $genres = Genre::find(request('ids'));

        foreach ($genres as $genre) {
            $genre->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
