@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.assetLocation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.asset-locations.update", [$assetLocation->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.assetLocation.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $assetLocation->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetLocation.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="code">{{ trans('cruds.assetLocation.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', $assetLocation->code) }}" required>
                @if($errors->has('code'))
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetLocation.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name_cee">{{ trans('cruds.assetLocation.fields.name_cee') }}</label>
                <input class="form-control {{ $errors->has('name_cee') ? 'is-invalid' : '' }}" type="text" name="name_cee" id="name_cee" value="{{ old('name_cee', $assetLocation->name_cee) }}" required>
                @if($errors->has('name_cee'))
                    <span class="text-danger">{{ $errors->first('name_cee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetLocation.fields.name_cee_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="network_id">{{ trans('cruds.assetLocation.fields.network') }}</label>
                <select class="form-control select2 {{ $errors->has('network') ? 'is-invalid' : '' }}" name="network_id" id="network_id" required>
                    @foreach($networks as $id => $network)
                        <option value="{{ $id }}" {{ (old('network_id') ? old('network_id') : $assetLocation->network->id ?? '') == $id ? 'selected' : '' }}>{{ $network }}</option>
                    @endforeach
                </select>
                @if($errors->has('network'))
                    <span class="text-danger">{{ $errors->first('network') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetLocation.fields.network_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="zone_id">{{ trans('cruds.assetLocation.fields.zone') }}</label>
                <select class="form-control select2 {{ $errors->has('zone') ? 'is-invalid' : '' }}" name="zone_id" id="zone_id">
                    @foreach($zones as $id => $zone)
                        <option value="{{ $id }}" {{ (old('zone_id') ? old('zone_id') : $assetLocation->zone->id ?? '') == $id ? 'selected' : '' }}>{{ $zone }}</option>
                    @endforeach
                </select>
                @if($errors->has('zone'))
                    <span class="text-danger">{{ $errors->first('zone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetLocation.fields.zone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="area_id">{{ trans('cruds.assetLocation.fields.area') }}</label>
                <select class="form-control select2 {{ $errors->has('area') ? 'is-invalid' : '' }}" name="area_id" id="area_id">
                    @foreach($areas as $id => $area)
                        <option value="{{ $id }}" {{ (old('area_id') ? old('area_id') : $assetLocation->area->id ?? '') == $id ? 'selected' : '' }}>{{ $area }}</option>
                    @endforeach
                </select>
                @if($errors->has('area'))
                    <span class="text-danger">{{ $errors->first('area') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetLocation.fields.area_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="province_id">{{ trans('cruds.assetLocation.fields.province') }}</label>
                <select class="form-control select2 {{ $errors->has('province') ? 'is-invalid' : '' }}" name="province_id" id="province_id">
                    @foreach($provinces as $id => $province)
                        <option value="{{ $id }}" {{ (old('province_id') ? old('province_id') : $assetLocation->province->id ?? '') == $id ? 'selected' : '' }}>{{ $province }}</option>
                    @endforeach
                </select>
                @if($errors->has('province'))
                    <span class="text-danger">{{ $errors->first('province') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetLocation.fields.province_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="municipality_id">{{ trans('cruds.assetLocation.fields.municipality') }}</label>
                <select class="form-control select2 {{ $errors->has('municipality') ? 'is-invalid' : '' }}" name="municipality_id" id="municipality_id">
                    @foreach($municipalities as $id => $municipality)
                        <option value="{{ $id }}" {{ (old('municipality_id') ? old('municipality_id') : $assetLocation->municipality->id ?? '') == $id ? 'selected' : '' }}>{{ $municipality }}</option>
                    @endforeach
                </select>
                @if($errors->has('municipality'))
                    <span class="text-danger">{{ $errors->first('municipality') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetLocation.fields.municipality_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.assetLocation.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $assetLocation->address) }}">
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetLocation.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="longitude">{{ trans('cruds.assetLocation.fields.longitude') }}</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="number" name="longitude" id="longitude" value="{{ old('longitude', $assetLocation->longitude) }}" step="0.000001">
                @if($errors->has('longitude'))
                    <span class="text-danger">{{ $errors->first('longitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetLocation.fields.longitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="latitude">{{ trans('cruds.assetLocation.fields.latitude') }}</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="number" name="latitude" id="latitude" value="{{ old('latitude', $assetLocation->latitude) }}" step="0.000001">
                @if($errors->has('latitude'))
                    <span class="text-danger">{{ $errors->first('latitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetLocation.fields.latitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="altitude">{{ trans('cruds.assetLocation.fields.altitude') }}</label>
                <input class="form-control {{ $errors->has('altitude') ? 'is-invalid' : '' }}" type="number" name="altitude" id="altitude" value="{{ old('altitude', $assetLocation->altitude) }}" step="0.01">
                @if($errors->has('altitude'))
                    <span class="text-danger">{{ $errors->first('altitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetLocation.fields.altitude_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="active" value="0">
                    <input class="form-check-input" type="checkbox" name="active" id="active" value="1" {{ $assetLocation->active || old('active', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">{{ trans('cruds.assetLocation.fields.active') }}</label>
                </div>
                @if($errors->has('active'))
                    <span class="text-danger">{{ $errors->first('active') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetLocation.fields.active_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('local_hour') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="local_hour" value="0">
                    <input class="form-check-input" type="checkbox" name="local_hour" id="local_hour" value="1" {{ $assetLocation->local_hour || old('local_hour', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="local_hour">{{ trans('cruds.assetLocation.fields.local_hour') }}</label>
                </div>
                @if($errors->has('local_hour'))
                    <span class="text-danger">{{ $errors->first('local_hour') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetLocation.fields.local_hour_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.assetLocation.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $assetLocation->description) }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetLocation.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_date">{{ trans('cruds.assetLocation.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date', $assetLocation->start_date) }}">
                @if($errors->has('start_date'))
                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetLocation.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_date">{{ trans('cruds.assetLocation.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date', $assetLocation->end_date) }}">
                @if($errors->has('end_date'))
                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetLocation.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="record_id">{{ trans('cruds.assetLocation.fields.record') }}</label>
                <select class="form-control select2 {{ $errors->has('record') ? 'is-invalid' : '' }}" name="record_id" id="record_id">
                    @foreach($records as $id => $record)
                        <option value="{{ $id }}" {{ (old('record_id') ? old('record_id') : $assetLocation->record->id ?? '') == $id ? 'selected' : '' }}>{{ $record }}</option>
                    @endforeach
                </select>
                @if($errors->has('record'))
                    <span class="text-danger">{{ $errors->first('record') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetLocation.fields.record_helper') }}</span>
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
