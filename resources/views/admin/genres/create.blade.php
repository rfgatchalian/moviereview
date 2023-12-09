@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.genre.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.genres.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="genre_name">{{ trans('cruds.genre.fields.genre_name') }}</label>
                <input class="form-control {{ $errors->has('genre_name') ? 'is-invalid' : '' }}" type="text" name="genre_name" id="genre_name" value="{{ old('genre_name', '') }}">
                @if($errors->has('genre_name'))
                    <span class="text-danger">{{ $errors->first('genre_name') }}</span>
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



@endsection