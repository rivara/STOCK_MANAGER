@extends('layouts.admin')
@section('content')
@can('incidences_subcategory_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.incidences-subcategories.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.incidencesSubcategory.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.incidencesSubcategory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-IncidencesSubcategory">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.incidencesSubcategory.fields.incidence_category') }}
                        </th>
                        <th>
                            {{ trans('cruds.incidencesSubcategory.fields.incidence_subcategory') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($incidencesSubcategories as $key => $incidencesSubcategory)
                        <tr data-entry-id="{{ $incidencesSubcategory->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $incidencesSubcategory->incidence_category->incidence_category ?? '' }}
                            </td>
                            <td>
                                {{ $incidencesSubcategory->incidence_subcategory ?? '' }}
                            </td>
                            <td>
                                @can('incidences_subcategory_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.incidences-subcategories.show', $incidencesSubcategory->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('incidences_subcategory_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.incidences-subcategories.edit', $incidencesSubcategory->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('incidences_subcategory_delete')
                                    <form action="{{ route('admin.incidences-subcategories.destroy', $incidencesSubcategory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('incidences_subcategory_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.incidences-subcategories.massDestroy') }}",
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
    order: [[ 2, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-IncidencesSubcategory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection