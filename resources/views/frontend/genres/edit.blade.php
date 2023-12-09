@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.genre.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.genres.update", [$genre->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="genre_name">{{ trans('cruds.genre.fields.genre_name') }}</label>
                            <input class="form-control" type="text" name="genre_name" id="genre_name" value="{{ old('genre_name', $genre->genre_name) }}">
                            @if($errors->has('genre_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('genre_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.genre.fields.genre_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection