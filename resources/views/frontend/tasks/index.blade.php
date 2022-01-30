@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('task_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.tasks.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Task">
                            <thead>
                                <tr>
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
                                    <th>
                                        {{ trans('cruds.asset.fields.name') }}
                                    </th>
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
                                    </td>
                                    <td>
                                    </td>
                                    <td>
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
                            <tbody>
                                @foreach($tasks as $key => $task)
                                    <tr data-entry-id="{{ $task->id }}">
                                        <td>
                                            {{ $task->id ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($task->tags as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $task->status->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $task->location->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $task->asset->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $task->asset->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $task->asset_status->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $task->period->period ?? '' }}
                                        </td>
                                        <td>
                                            {{ $task->incidence_category->incidence_category ?? '' }}
                                        </td>
                                        <td>
                                            {{ $task->incidence_subcategory->incidence_subcategory ?? '' }}
                                        </td>
                                        <td>
                                            {{ $task->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $task->start_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $task->due_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $task->end_date ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $task->lost_data ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $task->lost_data ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $task->assigned_to->name ?? '' }}
                                        </td>
                                        <td>
                                            @if($task->attachment)
                                                <a href="{{ $task->attachment->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $task->link ?? '' }}
                                        </td>
                                        <td>
                                            {{ $task->record->idrecord ?? '' }}
                                        </td>
                                        <td>
                                            {{ $task->job->idjob ?? '' }}
                                        </td>
                                        <td>
                                            @can('task_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.tasks.show', $task->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('task_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.tasks.edit', $task->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('task_delete')
                                                <form action="{{ route('frontend.tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('task_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.tasks.massDestroy') }}",
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
  let table = $('.datatable-Task:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
