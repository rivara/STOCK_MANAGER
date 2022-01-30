@extends('layouts.admin')
@section('content')
@can('record_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.records.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.record.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.record.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Record">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.record.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.record.fields.idrecord') }}
                        </th>
                        <th>
                            {{ trans('cruds.record.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.record.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.record.fields.url') }}
                        </th>
                        <th>
                            {{ trans('cruds.record.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.record.fields.created_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.record.fields.attached') }}
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
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Record::TYPE_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Record::STATUS_RADIO as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
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
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $key => $record)
                        <tr data-entry-id="{{ $record->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $record->id ?? '' }}
                            </td>
                            <td>
                                {{ $record->idrecord ?? '' }}
                            </td>
                            <td>
                                {{ $record->description ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Record::TYPE_SELECT[$record->type] ?? '' }}
                            </td>
                            <td>
                                {{ $record->url ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Record::STATUS_RADIO[$record->status] ?? '' }}
                            </td>
                            <td>
                                {{ $record->created_by->name ?? '' }}
                            </td>
                            <td>
                                @foreach($record->attached as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @can('record_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.records.show', $record->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan



                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 2, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Record:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
