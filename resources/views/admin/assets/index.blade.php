@extends('layouts.admin')
@section('content')
@can('asset_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.assets.create') }}">
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Asset">
            <thead>
                <tr>
                    <th width="10">

                    </th>
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('asset_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.assets.massDestroy') }}",
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
    ajax: "{{ route('admin.assets.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'name', name: 'name' },
{ data: 'category_name', name: 'category.name' },
{ data: 'serial_number', name: 'serial_number' },
{ data: 'start_date', name: 'start_date' },
{ data: 'end_date', name: 'end_date' },
{ data: 'status_name', name: 'status.name' },
{ data: 'location_name', name: 'location.name' },
{ data: 'notes', name: 'notes' },
{ data: 'regulations', name: 'regulations' },
{ data: 'mark_mark', name: 'mark.mark' },
{ data: 'sample_sample', name: 'sample.sample' },
{ data: 'record_idrecord', name: 'record.idrecord' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 2, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Asset').DataTable(dtOverrideGlobals);
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
