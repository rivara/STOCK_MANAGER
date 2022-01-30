@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.task.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.tasks.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="tags">{{ trans('cruds.task.fields.tag') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="tags[]" id="tags" multiple required>
                                @foreach($tags as $id => $tag)
                                    <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tags'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tags') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.tag_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="status_id">{{ trans('cruds.task.fields.status') }}</label>
                            <select class="form-control select2" name="status_id" id="status_id" required>
                                @foreach($statuses as $id => $status)
                                    <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="location_id">{{ trans('cruds.task.fields.location') }}</label>
                            <select class="form-control select2" name="location_id" id="location_id" required>
                                @foreach($locations as $id => $location)
                                    <option value="{{ $id }}" {{ old('location_id') == $id ? 'selected' : '' }}>{{ $location }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('location'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('location') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.location_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="asset_id">{{ trans('cruds.task.fields.asset') }}</label>
                            <select class="form-control select2" name="asset_id" id="asset_id" required>
                                @foreach($assets as $id => $asset)
                                    <option value="{{ $id }}" {{ old('asset_id') == $id ? 'selected' : '' }}>{{ $asset }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('asset'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('asset') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.asset_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="asset_status_id">{{ trans('cruds.task.fields.asset_status') }}</label>
                            <select class="form-control select2" name="asset_status_id" id="asset_status_id" required>
                                @foreach($asset_statuses as $id => $asset_status)
                                    <option value="{{ $id }}" {{ old('asset_status_id') == $id ? 'selected' : '' }}>{{ $asset_status }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('asset_status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('asset_status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.asset_status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="period_id">{{ trans('cruds.task.fields.period') }}</label>
                            <select class="form-control select2" name="period_id" id="period_id">
                                @foreach($periods as $id => $period)
                                    <option value="{{ $id }}" {{ old('period_id') == $id ? 'selected' : '' }}>{{ $period }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('period'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('period') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.period_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="incidence_category_id">{{ trans('cruds.task.fields.incidence_category') }}</label>
                            <select class="form-control select2" name="incidence_category_id" id="incidence_category_id">
                                @foreach($incidence_categories as $id => $incidence_category)
                                    <option value="{{ $id }}" {{ old('incidence_category_id') == $id ? 'selected' : '' }}>{{ $incidence_category }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('incidence_category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('incidence_category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.incidence_category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="incidence_subcategory_id">{{ trans('cruds.task.fields.incidence_subcategory') }}</label>
                            <select class="form-control select2" name="incidence_subcategory_id" id="incidence_subcategory_id">
                                @foreach($incidence_subcategories as $id => $incidence_subcategory)
                                    <option value="{{ $id }}" {{ old('incidence_subcategory_id') == $id ? 'selected' : '' }}>{{ $incidence_subcategory }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('incidence_subcategory'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('incidence_subcategory') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.incidence_subcategory_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.task.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="start_date">{{ trans('cruds.task.fields.start_date') }}</label>
                            <input class="form-control date" type="text" name="start_date" id="start_date" value="{{ old('start_date') }}">
                            @if($errors->has('start_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.start_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="due_date">{{ trans('cruds.task.fields.due_date') }}</label>
                            <input class="form-control date" type="text" name="due_date" id="due_date" value="{{ old('due_date') }}">
                            @if($errors->has('due_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('due_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.due_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="end_date">{{ trans('cruds.task.fields.end_date') }}</label>
                            <input class="form-control date" type="text" name="end_date" id="end_date" value="{{ old('end_date') }}">
                            @if($errors->has('end_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.end_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="lost_data" value="0">
                                <input type="checkbox" name="lost_data" id="lost_data" value="1" {{ old('lost_data', 0) == 1 ? 'checked' : '' }}>
                                <label for="lost_data">{{ trans('cruds.task.fields.lost_data') }}</label>
                            </div>
                            @if($errors->has('lost_data'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('lost_data') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.lost_data_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="assigned_to_id">{{ trans('cruds.task.fields.assigned_to') }}</label>
                            <select class="form-control select2" name="assigned_to_id" id="assigned_to_id">
                                @foreach($assigned_tos as $id => $assigned_to)
                                    <option value="{{ $id }}" {{ old('assigned_to_id') == $id ? 'selected' : '' }}>{{ $assigned_to }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('assigned_to'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('assigned_to') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.assigned_to_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="attachment">{{ trans('cruds.task.fields.attachment') }}</label>
                            <div class="needsclick dropzone" id="attachment-dropzone">
                            </div>
                            @if($errors->has('attachment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('attachment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.attachment_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link">{{ trans('cruds.task.fields.link') }}</label>
                            <input class="form-control" type="text" name="link" id="link" value="{{ old('link', '') }}">
                            @if($errors->has('link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="record_id">{{ trans('cruds.task.fields.record') }}</label>
                            <select class="form-control select2" name="record_id" id="record_id">
                                @foreach($records as $id => $record)
                                    <option value="{{ $id }}" {{ old('record_id') == $id ? 'selected' : '' }}>{{ $record }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('record'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('record') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.record_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="job_id">{{ trans('cruds.task.fields.job') }}</label>
                            <select class="form-control select2" name="job_id" id="job_id">
                                @foreach($jobs as $id => $job)
                                    <option value="{{ $id }}" {{ old('job_id') == $id ? 'selected' : '' }}>{{ $job }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('job'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.job_helper') }}</span>
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
