@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.movie.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.movies.index') }}">
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
                            <a class="btn btn-default" href="{{ route('frontend.movies.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection