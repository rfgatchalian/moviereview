@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.rating.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ratings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="movie_id">{{ trans('cruds.rating.fields.movie') }}</label>
                <select class="form-control select2 {{ $errors->has('movie') ? 'is-invalid' : '' }}" name="movie_id" id="movie_id">
                    @foreach($movies as $id => $entry)
                        <option value="{{ $id }}" {{ old('movie_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('movie'))
                    <span class="text-danger">{{ $errors->first('movie') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rating.fields.movie_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.rating.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rating.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.rating.fields.rate') }}</label>
                <select class="form-control {{ $errors->has('rate') ? 'is-invalid' : '' }}" name="rate" id="rate">
                    <option value disabled {{ old('rate', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Rating::RATE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('rate', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('rate'))
                    <span class="text-danger">{{ $errors->first('rate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rating.fields.rate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="review">{{ trans('cruds.rating.fields.review') }}</label>
                <input class="form-control {{ $errors->has('review') ? 'is-invalid' : '' }}" type="text" name="review" id="review" value="{{ old('review', '') }}">
                @if($errors->has('review'))
                    <span class="text-danger">{{ $errors->first('review') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rating.fields.review_helper') }}</span>
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