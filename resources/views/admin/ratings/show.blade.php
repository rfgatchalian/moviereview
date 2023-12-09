@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.rating.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ratings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.rating.fields.id') }}
                        </th>
                        <td>
                            {{ $rating->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rating.fields.movie') }}
                        </th>
                        <td>
                            {{ $rating->movie->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rating.fields.user') }}
                        </th>
                        <td>
                            {{ $rating->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rating.fields.rate') }}
                        </th>
                        <td>
                            {{ App\Models\Rating::RATE_SELECT[$rating->rate] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rating.fields.review') }}
                        </th>
                        <td>
                            {{ $rating->review }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ratings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection