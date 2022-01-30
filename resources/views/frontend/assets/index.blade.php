@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('asset_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.assets.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.asset.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Asset', 'route' => 'admin.assets.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.asset.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Asset">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.category') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.serial_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.start_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.end_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.location') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.regulations') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.mark') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.sample') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.record') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($asset_categories as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($asset_statuses as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($asset_locations as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($marks as $key => $item)
                                                <option value="{{ $item->mark }}">{{ $item->mark }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($samples as $key => $item)
                                                <option value="{{ $item->sample }}">{{ $item->sample }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($records as $key => $item)
                                                <option value="{{ $item->idrecord }}">{{ $item->idrecord }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assets as $key => $asset)
                                    <tr data-entry-id="{{ $asset->id }}">
                                        <td>
                                            {{ $asset->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->category->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->serial_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->start_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->end_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->status->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->location->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->regulations ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->mark->mark ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->sample->sample ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->record->idrecord ?? '' }}
                                        </td>
                                        <td>
                                            @can('asset_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.assets.show', $asset->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('asset_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.assets.edit', $asset->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('asset_delete')
                                                <form action="{{ route('frontend.assets.destroy', $asset->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('asset_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.assets.massDestroy') }}",
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
  let table = $('.datatable-Asset:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  $('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value
      table
        .column($(this).parent().index())
        .search(value, strict)
        .draw()
  });
})

</script>
@endsection
