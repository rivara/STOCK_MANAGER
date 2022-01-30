@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.mark.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.marks.update", [$mark->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="mark">{{ trans('cruds.mark.fields.mark') }}</label>
                <input class="form-control {{ $errors->has('mark') ? 'is-invalid' : '' }}" type="text" name="mark" id="mark" value="{{ old('mark', $mark->mark) }}" required>
                @if($errors->has('mark'))
                    <span class="text-danger">{{ $errors->first('mark') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mark.fields.mark_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.mark.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $mark->description) }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mark.fields.description_helper') }}</span>
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