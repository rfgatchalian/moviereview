@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.movie.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.movies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.movie.fields.id') }}
                        </th>
                        <td>
                            {{ $movie->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.movie.fields.poster') }}
                        </th>
                        <td>
                            @if($movie->poster)
                                <a href="{{ $movie->poster->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $movie->poster->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.movie.fields.genre') }}
                        </th>
                        <td>
                            @foreach($movie->genres as $key => $genre)
                                <span class="label label-info">{{ $genre->genre_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.movie.fields.title') }}
                        </th>
                        <td>
                            {{ $movie->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.movie.fields.cast') }}
                        </th>
                        <td>
                            {{ $movie->cast }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.movie.fields.description') }}
                        </th>
                        <td>
                            {{ $movie->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.movie.fields.trailer') }}
                        </th>
                        <td>
                            {{ $movie->trailer }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.movie.fields.director') }}
                        </th>
                        <td>
                            {{ $movie->director }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.movies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#movie_ratings" role="tab" data-toggle="tab">
                {{ trans('cruds.rating.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="movie_ratings">
            @includeIf('admin.movies.relationships.movieRatings', ['ratings' => $movie->movieRatings])
        </div>
    </div>
</div>

@endsection