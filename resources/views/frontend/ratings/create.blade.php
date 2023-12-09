@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.rating.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.ratings.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="movie_id">{{ trans('cruds.rating.fields.movie') }}</label>
                            <select class="form-control select2" name="movie_id" id="movie_id">
                                @foreach($movies as $id => $entry)
                                    <option value="{{ $id }}" {{ old('movie_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('movie'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('movie') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.rating.fields.movie_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.rating.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.rating.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.rating.fields.rate') }}</label>
                            <select class="form-control" name="rate" id="rate">
                                <option value disabled {{ old('rate', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Rating::RATE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('rate', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('rate'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rate') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.rating.fields.rate_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="review">{{ trans('cruds.rating.fields.review') }}</label>
                            <input class="form-control" type="text" name="review" id="review" value="{{ old('review', '') }}">
                            @if($errors->has('review'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('review') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection