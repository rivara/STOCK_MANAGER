@extends('layouts.admin')
@section('content')
@can('task_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tasks.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.task.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Task', 'route' => 'admin.tasks.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.task.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Task">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.task.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.tag') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.location') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.asset') }}
                    </th>
                    <!--<th>
                        {{ trans('cruds.asset.fields.name') }}
                    </th>-->
                    <th>
                        {{ trans('cruds.task.fields.asset_status') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.period') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.incidence_category') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.incidence_subcategory') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.start_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.due_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.end_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.lost_data') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.assigned_to') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.attachment') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.link') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.record') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.job') }}
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
                            @foreach($task_tags as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($task_statuses as $key => $item)
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
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($assets as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                   <!-- <td>
                    </td>-->
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
                            @foreach($periods as $key => $item)
                                <option value="{{ $item->period }}">{{ $item->period }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($incidences_categories as $key => $item)
                                <option value="{{ $item->incidence_category }}">{{ $item->incidence_category }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($incidences_subcategories as $key => $item)
                                <option value="{{ $item->incidence_subcategory }}">{{ $item->incidence_subcategory }}</option>
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
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
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
                            @foreach($records as $key => $item)
                                <option value="{{ $item->idrecord }}">{{ $item->idrecord }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($jobs as $key => $item)
                                <option value="{{ $item->idjob }}">{{ $item->idjob }}</option>
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
@can('task_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tasks.massDestroy') }}",
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
    ajax: "{{ route('admin.tasks.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'tag', name: 'tags.name' },
{ data: 'status_name', name: 'status.name' },
{ data: 'location_name', name: 'location.name' },
{ data: 'asset_name', name: 'asset.name' },
//{ data: 'asset.name', name: 'asset.name' },
{ data: 'asset_status_name', name: 'asset_status.name' },
{ data: 'period_period', name: 'period.period' },
{ data: 'incidence_category_incidence_category', name: 'incidence_category.incidence_category' },
{ data: 'incidence_subcategory_incidence_subcategory', name: 'incidence_subcategory.incidence_subcategory' },
{ data: 'description', name: 'description' },
{ data: 'start_date', name: 'start_date', searchable: true },
{ data: 'due_date', name: 'due_date', searchable: true },
{ data: 'end_date', name: 'end_date', searchable: true },
{ data: 'lost_data', name: 'lost_data' },
{ data: 'assigned_to_name', name: 'assigned_to.name' },
{ data: 'attachment', name: 'attachment', sortable: false, searchable: false },
{ data: 'link', name: 'link' },
{ data: 'record_idrecord', name: 'record.idrecord' },
{ data: 'job_idjob', name: 'job.idjob' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-Task').DataTable(dtOverrideGlobals);
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
