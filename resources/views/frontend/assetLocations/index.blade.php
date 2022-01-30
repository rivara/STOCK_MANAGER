@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('asset_location_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.asset-locations.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.assetLocation.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'AssetLocation', 'route' => 'admin.asset-locations.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.assetLocation.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-AssetLocation">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.name_cee') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.network') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.zone') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.area') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.province') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.municipality') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.address') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.longitude') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.latitude') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.altitude') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.active') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.local_hour') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.start_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.end_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.record') }}
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
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($networks as $key => $item)
                                                <option value="{{ $item->network }}">{{ $item->network }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($zones as $key => $item)
                                                <option value="{{ $item->zone }}">{{ $item->zone }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($areas as $key => $item)
                                                <option value="{{ $item->area }}">{{ $item->area }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($provinces as $key => $item)
                                                <option value="{{ $item->province }}">{{ $item->province }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($municipalities as $key => $item)
                                                <option value="{{ $item->municipality }}">{{ $item->municipality }}</option>
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
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                    <td>
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
                                @foreach($assetLocations as $key => $assetLocation)
                                    <tr data-entry-id="{{ $assetLocation->id }}">
                                        <td>
                                            {{ $assetLocation->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetLocation->code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetLocation->name_cee ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetLocation->network->network ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetLocation->zone->zone ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetLocation->area->area ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetLocation->province->province ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetLocation->municipality->municipality ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetLocation->address ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetLocation->longitude ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetLocation->latitude ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetLocation->altitude ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $assetLocation->active ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $assetLocation->active ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $assetLocation->local_hour ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $assetLocation->local_hour ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $assetLocation->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetLocation->start_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetLocation->end_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetLocation->record->idrecord ?? '' }}
                                        </td>
                                        <td>
                                            @can('asset_location_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.asset-locations.show', $assetLocation->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('asset_location_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.asset-locations.edit', $assetLocation->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('asset_location_delete')
                                                <form action="{{ route('frontend.asset-locations.destroy', $assetLocation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('asset_location_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.asset-locations.massDestroy') }}",
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
  let table = $('.datatable-AssetLocation:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
