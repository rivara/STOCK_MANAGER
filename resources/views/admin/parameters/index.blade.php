@extends('layouts.admin')
@section('content')
@can('parameter_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.parameters.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.parameter.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Parameter', 'route' => 'admin.parameters.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.parameter.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Parameter">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.parameter.fields.idmagnitude') }}
                    </th>
                    <th>
                        {{ trans('cruds.magnitude.fields.magnitude') }}
                    </th>
                    <th>
                        {{ trans('cruds.parameter.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.parameter.fields.technique') }}
                    </th>
                    <th>
                        {{ trans('cruds.parameter.fields.unit') }}
                    </th>
                    <th>
                        {{ trans('cruds.parameter.fields.calculation') }}
                    </th>
                    <th>
                        {{ trans('cruds.parameter.fields.active') }}
                    </th>
                    <th>
                        {{ trans('cruds.parameter.fields.period') }}
                    </th>
                    <th>
                        {{ trans('cruds.parameter.fields.decimals') }}
                    </th>
                    <th>
                        {{ trans('cruds.parameter.fields.max_value') }}
                    </th>
                    <th>
                        {{ trans('cruds.parameter.fields.min_value') }}
                    </th>
                    <th>
                        {{ trans('cruds.parameter.fields.location') }}
                    </th>
                    <th>
                        {{ trans('cruds.parameter.fields.asset') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.parameter.fields.start_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.parameter.fields.end_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.parameter.fields.formula') }}
                    </th>
                    <th>
                        {{ trans('cruds.parameter.fields.alarm') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($magnitudes as $key => $item)
                                <option value="{{ $item->magnitude }}">{{ $item->magnitude }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($techniques as $key => $item)
                                <option value="{{ $item->technique }}">{{ $item->technique }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($units as $key => $item)
                                <option value="{{ $item->unit }}">{{ $item->unit }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($calculations as $key => $item)
                                <option value="{{ $item->calculation }}">{{ $item->calculation }}</option>
                            @endforeach
                        </select>
                    </td>
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
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($assets as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
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
@can('parameter_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.parameters.massDestroy') }}",
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
    ajax: "{{ route('admin.parameters.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'idmagnitude_magnitude', name: 'idmagnitude.magnitude' },
{ data: 'idmagnitude.magnitude', name: 'idmagnitude.magnitude' },
{ data: 'description', name: 'description' },
{ data: 'technique_technique', name: 'technique.technique' },
{ data: 'unit_unit', name: 'unit.unit' },
{ data: 'calculation_calculation', name: 'calculation.calculation' },
{ data: 'active', name: 'active' },
{ data: 'period', name: 'period' },
{ data: 'decimals', name: 'decimals' },
{ data: 'max_value', name: 'max_value' },
{ data: 'min_value', name: 'min_value' },
{ data: 'location_name', name: 'location.name' },
{ data: 'asset_name', name: 'asset.name' },
{ data: 'asset.name', name: 'asset.name' },
{ data: 'start_date', name: 'start_date' },
{ data: 'end_date', name: 'end_date' },
{ data: 'formula', name: 'formula' },
{ data: 'alarm', name: 'alarm' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Parameter').DataTable(dtOverrideGlobals);
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