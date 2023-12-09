@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.movie.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.movies.update", [$movie->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="poster">{{ trans('cruds.movie.fields.poster') }}</label>
                <div class="needsclick dropzone {{ $errors->has('poster') ? 'is-invalid' : '' }}" id="poster-dropzone">
                </div>
                @if($errors->has('poster'))
                    <span class="text-danger">{{ $errors->first('poster') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.movie.fields.poster_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="genres">{{ trans('cruds.movie.fields.genre') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('genres') ? 'is-invalid' : '' }}" name="genres[]" id="genres" multiple>
                    @foreach($genres as $id => $genre)
                        <option value="{{ $id }}" {{ (in_array($id, old('genres', [])) || $movie->genres->contains($id)) ? 'selected' : '' }}>{{ $genre }}</option>
                    @endforeach
                </select>
                @if($errors->has('genres'))
                    <span class="text-danger">{{ $errors->first('genres') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.movie.fields.genre_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="title">{{ trans('cruds.movie.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $movie->title) }}">
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.movie.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cast">{{ trans('cruds.movie.fields.cast') }}</label>
                <input class="form-control {{ $errors->has('cast') ? 'is-invalid' : '' }}" type="text" name="cast" id="cast" value="{{ old('cast', $movie->cast) }}">
                @if($errors->has('cast'))
                    <span class="text-danger">{{ $errors->first('cast') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.movie.fields.cast_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.movie.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $movie->description) }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.movie.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="trailer">{{ trans('cruds.movie.fields.trailer') }}</label>
                <input class="form-control {{ $errors->has('trailer') ? 'is-invalid' : '' }}" type="text" name="trailer" id="trailer" value="{{ old('trailer', $movie->trailer) }}">
                @if($errors->has('trailer'))
                    <span class="text-danger">{{ $errors->first('trailer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.movie.fields.trailer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="director">{{ trans('cruds.movie.fields.director') }}</label>
                <input class="form-control {{ $errors->has('director') ? 'is-invalid' : '' }}" type="text" name="director" id="director" value="{{ old('director', $movie->director) }}">
                @if($errors->has('director'))
                    <span class="text-danger">{{ $errors->first('director') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.movie.fields.director_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.posterDropzone = {
    url: '{{ route('admin.movies.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="poster"]').remove()
      $('form').append('<input type="hidden" name="poster" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="poster"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($movie) && $movie->poster)
      var file = {!! json_encode($movie->poster) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="poster" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection