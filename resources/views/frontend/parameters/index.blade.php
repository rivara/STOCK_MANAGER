@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('parameter_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.parameters.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Parameter">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($parameters as $key => $parameter)
                                    <tr data-entry-id="{{ $parameter->id }}">
                                        <td>
                                            {{ $parameter->idmagnitude->magnitude ?? '' }}
                                        </td>
                                        <td>
                                            {{ $parameter->idmagnitude->magnitude ?? '' }}
                                        </td>
                                        <td>
                                            {{ $parameter->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $parameter->technique->technique ?? '' }}
                                        </td>
                                        <td>
                                            {{ $parameter->unit->unit ?? '' }}
                                        </td>
                                        <td>
                                            {{ $parameter->calculation->calculation ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $parameter->active ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $parameter->active ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $parameter->period ?? '' }}
                                        </td>
                                        <td>
                                            {{ $parameter->decimals ?? '' }}
                                        </td>
                                        <td>
                                            {{ $parameter->max_value ?? '' }}
                                        </td>
                                        <td>
                                            {{ $parameter->min_value ?? '' }}
                                        </td>
                                        <td>
                                            {{ $parameter->location->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $parameter->asset->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $parameter->asset->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $parameter->start_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $parameter->end_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $parameter->formula ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $parameter->alarm ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $parameter->alarm ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @can('parameter_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.parameters.show', $parameter->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('parameter_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.parameters.edit', $parameter->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('parameter_delete')
                                                <form action="{{ route('frontend.parameters.destroy', $parameter->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('parameter_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.parameters.massDestroy') }}",
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
  let table = $('.datatable-Parameter:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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