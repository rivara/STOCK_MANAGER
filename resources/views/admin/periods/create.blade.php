@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.period.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.periods.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="period">{{ trans('cruds.period.fields.period') }}</label>
                <input class="form-control {{ $errors->has('period') ? 'is-invalid' : '' }}" type="text" name="period" id="period" value="{{ old('period', '') }}" required>
                @if($errors->has('period'))
                    <span class="text-danger">{{ $errors->first('period') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.period.fields.period_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="value">{{ trans('cruds.period.fields.value') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="number" name="value" id="value" value="{{ old('value', '0') }}" step="1" required>
                @if($errors->has('value'))
                    <span class="text-danger">{{ $errors->first('value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.period.fields.value_helper') }}</span>
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