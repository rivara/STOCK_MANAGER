@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.assetsHistory.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-AssetsHistory">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetsHistory.fields.asset') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetsHistory.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetsHistory.fields.location') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetsHistory.fields.start_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetsHistory.fields.end_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetsHistory.fields.created_at') }}
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
                                            @foreach($assets as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
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
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assetsHistories as $key => $assetsHistory)
                                    <tr data-entry-id="{{ $assetsHistory->id }}">
                                        <td>
                                            {{ $assetsHistory->asset->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetsHistory->status->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetsHistory->location->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetsHistory->start_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetsHistory->end_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetsHistory->created_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('assets_history_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.assets-histories.show', $assetsHistory->id) }}">
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
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-AssetsHistory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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