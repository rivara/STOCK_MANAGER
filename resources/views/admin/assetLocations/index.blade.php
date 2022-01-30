@extends('layouts.admin')
@section('content')
@can('asset_location_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.asset-locations.create') }}">
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AssetLocation">
            <thead>
                <tr>
                    <th width="10">

                    </th>
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
                          <!-- RVR
                        <select class="search" >
                         <option value>{ trans('global.all') }}</option>
                            foreach($records as $key => $item)
                                <option value="{ $item->idrecord }}">{ $item->idrecord }}</option>
                            endforeach
                        </select>
                          -->
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('asset_location_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.asset-locations.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.asset-locations.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'name', name: 'name' },
{ data: 'code', name: 'code' },
{ data: 'name_cee', name: 'name_cee' },
{ data: 'network_network', name: 'network.network' },
{ data: 'zone_zone', name: 'zone.zone' },
{ data: 'area_area', name: 'area.area' },
{ data: 'province_province', name: 'province.province' },
{ data: 'municipality_municipality', name: 'municipality.municipality' },
{ data: 'address', name: 'address' },
{ data: 'longitude', name: 'longitude' },
{ data: 'latitude', name: 'latitude' },
{ data: 'altitude', name: 'altitude' },
{ data: 'active', name: 'active' },
{ data: 'local_hour', name: 'local_hour' },
{ data: 'description', name: 'description' },
{ data: 'start_date', name: 'start_date' },
{ data: 'end_date', name: 'end_date' },
{ data: 'record_idrecord', name: 'record.idrecord' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-AssetLocation').DataTable(dtOverrideGlobals);
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
});

</script>
@endsection
