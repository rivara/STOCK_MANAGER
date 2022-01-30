@extends('adminlte::page')
@section('title', 'Dashboard')


@section('content_header')

@stop


@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.task.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("dnota.dnota.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="ubicacion_id">{{ trans('cruds.task.fields.ubicacion') }}</label>
                <select class="form-control select2 {{ $errors->has('ubicacion') ? 'is-invalid' : '' }}" name="ubicacion_id" id="ubicacion_id" required>
                    @foreach($ubicacions as $id => $ubicacion)
                        <option value="{{ $id }}" {{ old('ubicacion_id') == $id ? 'selected' : '' }}>{{ $ubicacion }}</option>
                    @endforeach
                </select>
                @if($errors->has('ubicacion'))
                    <span class="text-danger">{{ $errors->first('ubicacion') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.ubicacion_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="equipo_id">{{ trans('cruds.task.fields.equipo') }}</label>
                <select class="form-control select2 {{ $errors->has('equipo') ? 'is-invalid' : '' }}" name="equipo_id" id="equipo_id" required>
                    @foreach($equipos as $id => $equipo)
                        <option value="{{ $id }}" {{ old('equipo_id') == $id ? 'selected' : '' }}>{{ $equipo }}</option>
                    @endforeach
                </select>
                @if($errors->has('equipo'))
                    <span class="text-danger">{{ $errors->first('equipo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.equipo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="estado_equipo_id">{{ trans('cruds.task.fields.estado_equipo') }}</label>
                <select class="form-control select2 {{ $errors->has('estado_equipo') ? 'is-invalid' : '' }}" name="estado_equipo_id" id="estado_equipo_id" required>
                    @foreach($estado_equipos as $id => $estado_equipo)
                        <option value="{{ $id }}" {{ old('estado_equipo_id') == $id ? 'selected' : '' }}>{{ $estado_equipo }}</option>
                    @endforeach
                </select>
                @if($errors->has('estado_equipo'))
                    <span class="text-danger">{{ $errors->first('estado_equipo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.estado_equipo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tags">{{ trans('cruds.task.fields.tag') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple required>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.tag_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="periodicidad_id">{{ trans('cruds.task.fields.periodicidad') }}</label>
                <select class="form-control select2 {{ $errors->has('periodicidad') ? 'is-invalid' : '' }}" name="periodicidad_id" id="periodicidad_id" required>
                    @foreach($periodicidads as $id => $periodicidad)
                        <option value="{{ $id }}" {{ old('periodicidad_id') == $id ? 'selected' : '' }}>{{ $periodicidad }}</option>
                    @endforeach
                </select>
                @if($errors->has('periodicidad'))
                    <span class="text-danger">{{ $errors->first('periodicidad') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.periodicidad_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tipo_incidencia_id">{{ trans('cruds.task.fields.tipo_incidencia') }}</label>
                <select class="form-control select2 {{ $errors->has('tipo_incidencia') ? 'is-invalid' : '' }}" name="tipo_incidencia_id" id="tipo_incidencia_id">
                    @foreach($tipo_incidencias as $id => $tipo_incidencia)
                        <option value="{{ $id }}" {{ old('tipo_incidencia_id') == $id ? 'selected' : '' }}>{{ $tipo_incidencia }}</option>
                    @endforeach
                </select>
                @if($errors->has('tipo_incidencia'))
                    <span class="text-danger">{{ $errors->first('tipo_incidencia') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.tipo_incidencia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="subtipo_incidencia_id">{{ trans('cruds.task.fields.subtipo_incidencia') }}</label>
                <select class="form-control select2 {{ $errors->has('subtipo_incidencia') ? 'is-invalid' : '' }}" name="subtipo_incidencia_id" id="subtipo_incidencia_id">
                    @foreach($subtipo_incidencias as $id => $subtipo_incidencia)
                        <option value="{{ $id }}" {{ old('subtipo_incidencia_id') == $id ? 'selected' : '' }}>{{ $subtipo_incidencia }}</option>
                    @endforeach
                </select>
                @if($errors->has('subtipo_incidencia'))
                    <span class="text-danger">{{ $errors->first('subtipo_incidencia') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.subtipo_incidencia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.task.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.task.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $status)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fecha_inicio">{{ trans('cruds.task.fields.fecha_inicio') }}</label>
                <input class="form-control date {{ $errors->has('fecha_inicio') ? 'is-invalid' : '' }}" type="text" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio') }}">
                @if($errors->has('fecha_inicio'))
                    <span class="text-danger">{{ $errors->first('fecha_inicio') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.fecha_inicio_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fecha_fin">{{ trans('cruds.task.fields.fecha_fin') }}</label>
                <input class="form-control date {{ $errors->has('fecha_fin') ? 'is-invalid' : '' }}" type="text" name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin') }}">
                @if($errors->has('fecha_fin'))
                    <span class="text-danger">{{ $errors->first('fecha_fin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.fecha_fin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="due_date">{{ trans('cruds.task.fields.due_date') }}</label>
                <input class="form-control date {{ $errors->has('due_date') ? 'is-invalid' : '' }}" type="text" name="due_date" id="due_date" value="{{ old('due_date') }}">
                @if($errors->has('due_date'))
                    <span class="text-danger">{{ $errors->first('due_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.due_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="assigned_to_id">{{ trans('cruds.task.fields.assigned_to') }}</label>
                <select class="form-control select2 {{ $errors->has('assigned_to') ? 'is-invalid' : '' }}" name="assigned_to_id" id="assigned_to_id">
                    @foreach($assigned_tos as $id => $assigned_to)
                        <option value="{{ $id }}" {{ old('assigned_to_id') == $id ? 'selected' : '' }}>{{ $assigned_to }}</option>
                    @endforeach
                </select>
                @if($errors->has('assigned_to'))
                    <span class="text-danger">{{ $errors->first('assigned_to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.assigned_to_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('perdida_datos') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="perdida_datos" value="0">
                    <input class="form-check-input" type="checkbox" name="perdida_datos" id="perdida_datos" value="1" {{ old('perdida_datos', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="perdida_datos">{{ trans('cruds.task.fields.perdida_datos') }}</label>
                </div>
                @if($errors->has('perdida_datos'))
                    <span class="text-danger">{{ $errors->first('perdida_datos') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.perdida_datos_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attachment">{{ trans('cruds.task.fields.attachment') }}</label>
                <div class="needsclick dropzone {{ $errors->has('attachment') ? 'is-invalid' : '' }}" id="attachment-dropzone">
                </div>
                @if($errors->has('attachment'))
                    <span class="text-danger">{{ $errors->first('attachment') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.attachment_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.task.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}">
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.attachmentDropzone = {
    url: '{{ route('admin.tasks.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="attachment"]').remove()
      $('form').append('<input type="hidden" name="attachment" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="attachment"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($task) && $task->attachment)
      var file = {!! json_encode($task->attachment) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="attachment" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection
