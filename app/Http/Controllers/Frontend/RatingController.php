<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRatingRequest;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Models\Movie;
use App\Models\Rating;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RatingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rating_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ratings = Rating::with(['movie', 'user'])->get();

        return view('frontend.ratings.index', compact('ratings'));
    }

    public function create()
    {
        abort_if(Gate::denies('rating_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $movies = Movie::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.ratings.create', compact('movies', 'users'));
    }

    public function store(StoreRatingRequest $request)
    {
        $rating = Rating::create($request->all());

        return redirect()->route('frontend.ratings.index');
    }

    public function edit(Rating $rating)
    {
        abort_if(Gate::denies('rating_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $movies = Movie::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rating->load('movie', 'user');

        return view('frontend.ratings.edit', compact('movies', 'rating', 'users'));
    }

    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        $rating->update($request->all());

        return redirect()->route('frontend.ratings.index');
    }

    public function show(Rating $rating)
    {
        abort_if(Gate::denies('rating_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rating->load('movie', 'user');

        return view('frontend.ratings.show', compact('rating'));
    }

    public function destroy(Rating $rating)
    {
        abort_if(Gate::denies('rating_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rating->delete();

        return back();
    }

    public function massDestroy(MassDestroyRatingRequest $request)
    {
        $ratings = Rating::find(request('ids'));

        foreach ($ratings as $rating) {
            $rating->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
