@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('movie_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.movies.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.movie.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.movie.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Movie">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.movie.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.movie.fields.poster') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.movie.fields.genre') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.movie.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.movie.fields.cast') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.movie.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.movie.fields.trailer') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.movie.fields.director') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($movies as $key => $movie)
                                    <tr data-entry-id="{{ $movie->id }}">
                                        <td>
                                            {{ $movie->id ?? '' }}
                                        </td>
                                        <td>
                                            @if($movie->poster)
                                                <a href="{{ $movie->poster->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $movie->poster->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @foreach($movie->genres as $key => $item)
                                                <span>{{ $item->genre_name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $movie->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $movie->cast ?? '' }}
                                        </td>
                                        <td>
                                            {{ $movie->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $movie->trailer ?? '' }}
                                        </td>
                                        <td>
                                            {{ $movie->director ?? '' }}
                                        </td>
                                        <td>
                                            @can('movie_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.movies.show', $movie->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('movie_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.movies.edit', $movie->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('movie_delete')
                                                <form action="{{ route('frontend.movies.destroy', $movie->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('movie_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.movies.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Movie:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection