@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.unit.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.units.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="unit">{{ trans('cruds.unit.fields.unit') }}</label>
                <input class="form-control {{ $errors->has('unit') ? 'is-invalid' : '' }}" type="text" name="unit" id="unit" value="{{ old('unit', '') }}" required>
                @if($errors->has('unit'))
                    <span class="text-danger">{{ $errors->first('unit') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.unit.fields.unit_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.unit.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.unit.fields.description_helper') }}</span>
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