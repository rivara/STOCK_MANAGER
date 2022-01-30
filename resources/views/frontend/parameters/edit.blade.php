@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.parameter.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.parameters.update", [$parameter->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="idmagnitude_id">{{ trans('cruds.parameter.fields.idmagnitude') }}</label>
                            <select class="form-control select2" name="idmagnitude_id" id="idmagnitude_id" required>
                                @foreach($idmagnitudes as $id => $idmagnitude)
                                    <option value="{{ $id }}" {{ (old('idmagnitude_id') ? old('idmagnitude_id') : $parameter->idmagnitude->id ?? '') == $id ? 'selected' : '' }}>{{ $idmagnitude }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('idmagnitude'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('idmagnitude') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.parameter.fields.idmagnitude_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="description">{{ trans('cruds.parameter.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', $parameter->description) }}" required>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.parameter.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="technique_id">{{ trans('cruds.parameter.fields.technique') }}</label>
                            <select class="form-control select2" name="technique_id" id="technique_id" required>
                                @foreach($techniques as $id => $technique)
                                    <option value="{{ $id }}" {{ (old('technique_id') ? old('technique_id') : $parameter->technique->id ?? '') == $id ? 'selected' : '' }}>{{ $technique }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('technique'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('technique') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.parameter.fields.technique_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="unit_id">{{ trans('cruds.parameter.fields.unit') }}</label>
                            <select class="form-control select2" name="unit_id" id="unit_id">
                                @foreach($units as $id => $unit)
                                    <option value="{{ $id }}" {{ (old('unit_id') ? old('unit_id') : $parameter->unit->id ?? '') == $id ? 'selected' : '' }}>{{ $unit }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('unit'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('unit') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.parameter.fields.unit_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="calculation_id">{{ trans('cruds.parameter.fields.calculation') }}</label>
                            <select class="form-control select2" name="calculation_id" id="calculation_id" required>
                                @foreach($calculations as $id => $calculation)
                                    <option value="{{ $id }}" {{ (old('calculation_id') ? old('calculation_id') : $parameter->calculation->id ?? '') == $id ? 'selected' : '' }}>{{ $calculation }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('calculation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('calculation') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.parameter.fields.calculation_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="active" value="0">
                                <input type="checkbox" name="active" id="active" value="1" {{ $parameter->active || old('active', 0) === 1 ? 'checked' : '' }}>
                                <label for="active">{{ trans('cruds.parameter.fields.active') }}</label>
                            </div>
                            @if($errors->has('active'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('active') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.parameter.fields.active_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="period">{{ trans('cruds.parameter.fields.period') }}</label>
                            <input class="form-control" type="number" name="period" id="period" value="{{ old('period', $parameter->period) }}" step="1" required>
                            @if($errors->has('period'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('period') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.parameter.fields.period_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="decimals">{{ trans('cruds.parameter.fields.decimals') }}</label>
                            <input class="form-control" type="number" name="decimals" id="decimals" value="{{ old('decimals', $parameter->decimals) }}" step="1">
                            @if($errors->has('decimals'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('decimals') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.parameter.fields.decimals_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="max_value">{{ trans('cruds.parameter.fields.max_value') }}</label>
                            <input class="form-control" type="number" name="max_value" id="max_value" value="{{ old('max_value', $parameter->max_value) }}" step="0.0001">
                            @if($errors->has('max_value'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('max_value') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.parameter.fields.max_value_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="min_value">{{ trans('cruds.parameter.fields.min_value') }}</label>
                            <input class="form-control date" type="text" name="min_value" id="min_value" value="{{ old('min_value', $parameter->min_value) }}">
                            @if($errors->has('min_value'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('min_value') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.parameter.fields.min_value_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="location_id">{{ trans('cruds.parameter.fields.location') }}</label>
                            <select class="form-control select2" name="location_id" id="location_id" required>
                                @foreach($locations as $id => $location)
                                    <option value="{{ $id }}" {{ (old('location_id') ? old('location_id') : $parameter->location->id ?? '') == $id ? 'selected' : '' }}>{{ $location }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('location'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('location') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.parameter.fields.location_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="asset_id">{{ trans('cruds.parameter.fields.asset') }}</label>
                            <select class="form-control select2" name="asset_id" id="asset_id">
                                @foreach($assets as $id => $asset)
                                    <option value="{{ $id }}" {{ (old('asset_id') ? old('asset_id') : $parameter->asset->id ?? '') == $id ? 'selected' : '' }}>{{ $asset }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('asset'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('asset') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.parameter.fields.asset_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="start_date">{{ trans('cruds.parameter.fields.start_date') }}</label>
                            <input class="form-control date" type="text" name="start_date" id="start_date" value="{{ old('start_date', $parameter->start_date) }}">
                            @if($errors->has('start_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.parameter.fields.start_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="end_date">{{ trans('cruds.parameter.fields.end_date') }}</label>
                            <input class="form-control date" type="text" name="end_date" id="end_date" value="{{ old('end_date', $parameter->end_date) }}">
                            @if($errors->has('end_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.parameter.fields.end_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="formula">{{ trans('cruds.parameter.fields.formula') }}</label>
                            <input class="form-control" type="text" name="formula" id="formula" value="{{ old('formula', $parameter->formula) }}">
                            @if($errors->has('formula'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('formula') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.parameter.fields.formula_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="checkbox" name="alarm" id="alarm" value="1" {{ $parameter->alarm || old('alarm', 0) === 1 ? 'checked' : '' }} required>
                                <label class="required" for="alarm">{{ trans('cruds.parameter.fields.alarm') }}</label>
                            </div>
                            @if($errors->has('alarm'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('alarm') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection