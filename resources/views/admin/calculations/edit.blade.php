@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.calculation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.calculations.update", [$calculation->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="calculation">{{ trans('cruds.calculation.fields.calculation') }}</label>
                <input class="form-control {{ $errors->has('calculation') ? 'is-invalid' : '' }}" type="text" name="calculation" id="calculation" value="{{ old('calculation', $calculation->calculation) }}" required>
                @if($errors->has('calculation'))
                    <span class="text-danger">{{ $errors->first('calculation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.calculation.fields.calculation_helper') }}</span>
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