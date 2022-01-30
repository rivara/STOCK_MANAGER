@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.record.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.records.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="description">{{ trans('cruds.record.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', '') }}" required>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.record.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.record.fields.type') }}</label>
                            <select class="form-control" name="type" id="type" required>
                                <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Record::TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.record.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="url">{{ trans('cruds.record.fields.url') }}</label>
                            <input class="form-control" type="text" name="url" id="url" value="{{ old('url', '') }}">
                            @if($errors->has('url'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('url') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.record.fields.url_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.record.fields.status') }}</label>
                            @foreach(App\Models\Record::STATUS_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', '') === (string) $key ? 'checked' : '' }}>
                                    <label for="status_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.record.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="created_by_id">{{ trans('cruds.record.fields.created_by') }}</label>
                            <select class="form-control select2" name="created_by_id" id="created_by_id">
                                @foreach($created_bies as $id => $created_by)
                                    <option value="{{ $id }}" {{ old('created_by_id') == $id ? 'selected' : '' }}>{{ $created_by }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('created_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('created_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.record.fields.created_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="attached">{{ trans('cruds.record.fields.attached') }}</label>
                            <div class="needsclick dropzone" id="attached-dropzone">
                            </div>
                            @if($errors->has('attached'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('attached') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.record.fields.attached_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var uploadedAttachedMap = {}
Dropzone.options.attachedDropzone = {
    url: '{{ route('admin.records.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="attached[]" value="' + response.name + '">')
      uploadedAttachedMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAttachedMap[file.name]
      }
      $('form').find('input[name="attached[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($record) && $record->attached)
          var files =
            {!! json_encode($record->attached) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="attached[]" value="' + file.file_name + '">')
            }
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
