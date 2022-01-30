@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.parameter.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.parameters.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="idmagnitude_id">{{ trans('cruds.parameter.fields.idmagnitude') }}</label>
                <select class="form-control select2 {{ $errors->has('idmagnitude') ? 'is-invalid' : '' }}" name="idmagnitude_id" id="idmagnitude_id" required>
                    @foreach($idmagnitudes as $id => $idmagnitude)
                        <option value="{{ $id }}" {{ old('idmagnitude_id') == $id ? 'selected' : '' }}>{{ $idmagnitude }}</option>
                    @endforeach
                </select>
                @if($errors->has('idmagnitude'))
                    <span class="text-danger">{{ $errors->first('idmagnitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.idmagnitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.parameter.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}" required>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="technique_id">{{ trans('cruds.parameter.fields.technique') }}</label>
                <select class="form-control select2 {{ $errors->has('technique') ? 'is-invalid' : '' }}" name="technique_id" id="technique_id" required>
                    @foreach($techniques as $id => $technique)
                        <option value="{{ $id }}" {{ old('technique_id') == $id ? 'selected' : '' }}>{{ $technique }}</option>
                    @endforeach
                </select>
                @if($errors->has('technique'))
                    <span class="text-danger">{{ $errors->first('technique') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.technique_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="unit_id">{{ trans('cruds.parameter.fields.unit') }}</label>
                <select class="form-control select2 {{ $errors->has('unit') ? 'is-invalid' : '' }}" name="unit_id" id="unit_id">
                    @foreach($units as $id => $unit)
                        <option value="{{ $id }}" {{ old('unit_id') == $id ? 'selected' : '' }}>{{ $unit }}</option>
                    @endforeach
                </select>
                @if($errors->has('unit'))
                    <span class="text-danger">{{ $errors->first('unit') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.unit_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="calculation_id">{{ trans('cruds.parameter.fields.calculation') }}</label>
                <select class="form-control select2 {{ $errors->has('calculation') ? 'is-invalid' : '' }}" name="calculation_id" id="calculation_id" required>
                    @foreach($calculations as $id => $calculation)
                        <option value="{{ $id }}" {{ old('calculation_id') == $id ? 'selected' : '' }}>{{ $calculation }}</option>
                    @endforeach
                </select>
                @if($errors->has('calculation'))
                    <span class="text-danger">{{ $errors->first('calculation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.calculation_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="active" value="0">
                    <input class="form-check-input" type="checkbox" name="active" id="active" value="1" {{ old('active', 0) == 1 || old('active') === null ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">{{ trans('cruds.parameter.fields.active') }}</label>
                </div>
                @if($errors->has('active'))
                    <span class="text-danger">{{ $errors->first('active') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.active_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="period">{{ trans('cruds.parameter.fields.period') }}</label>
                <input class="form-control {{ $errors->has('period') ? 'is-invalid' : '' }}" type="number" name="period" id="period" value="{{ old('period', '') }}" step="1" required>
                @if($errors->has('period'))
                    <span class="text-danger">{{ $errors->first('period') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.period_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="decimals">{{ trans('cruds.parameter.fields.decimals') }}</label>
                <input class="form-control {{ $errors->has('decimals') ? 'is-invalid' : '' }}" type="number" name="decimals" id="decimals" value="{{ old('decimals', '0') }}" step="1">
                @if($errors->has('decimals'))
                    <span class="text-danger">{{ $errors->first('decimals') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.decimals_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="max_value">{{ trans('cruds.parameter.fields.max_value') }}</label>
                <input class="form-control {{ $errors->has('max_value') ? 'is-invalid' : '' }}" type="number" name="max_value" id="max_value" value="{{ old('max_value', '') }}" step="0.0001">
                @if($errors->has('max_value'))
                    <span class="text-danger">{{ $errors->first('max_value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.max_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="min_value">{{ trans('cruds.parameter.fields.min_value') }}</label>
                <input class="form-control date {{ $errors->has('min_value') ? 'is-invalid' : '' }}" type="text" name="min_value" id="min_value" value="{{ old('min_value') }}">
                @if($errors->has('min_value'))
                    <span class="text-danger">{{ $errors->first('min_value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.min_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="location_id">{{ trans('cruds.parameter.fields.location') }}</label>
                <select class="form-control select2 {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location_id" id="location_id" required>
                    @foreach($locations as $id => $location)
                        <option value="{{ $id }}" {{ old('location_id') == $id ? 'selected' : '' }}>{{ $location }}</option>
                    @endforeach
                </select>
                @if($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="asset_id">{{ trans('cruds.parameter.fields.asset') }}</label>
                <select class="form-control select2 {{ $errors->has('asset') ? 'is-invalid' : '' }}" name="asset_id" id="asset_id">
                    @foreach($assets as $id => $asset)
                        <option value="{{ $id }}" {{ old('asset_id') == $id ? 'selected' : '' }}>{{ $asset }}</option>
                    @endforeach
                </select>
                @if($errors->has('asset'))
                    <span class="text-danger">{{ $errors->first('asset') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.asset_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_date">{{ trans('cruds.parameter.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date') }}">
                @if($errors->has('start_date'))
                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_date">{{ trans('cruds.parameter.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date') }}">
                @if($errors->has('end_date'))
                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="formula">{{ trans('cruds.parameter.fields.formula') }}</label>
                <input class="form-control {{ $errors->has('formula') ? 'is-invalid' : '' }}" type="text" name="formula" id="formula" value="{{ old('formula', '') }}">
                @if($errors->has('formula'))
                    <span class="text-danger">{{ $errors->first('formula') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.formula_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('alarm') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="alarm" id="alarm" value="1" required {{ old('alarm', 0) == 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="alarm">{{ trans('cruds.parameter.fields.alarm') }}</label>
                </div>
                @if($errors->has('alarm'))
                    <span class="text-danger">{{ $errors->first('alarm') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.alarm_helper') }}</span>
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