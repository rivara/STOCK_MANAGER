@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.assetLocation.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.asset-locations.update", [$assetLocation->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.assetLocation.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $assetLocation->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetLocation.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="code">{{ trans('cruds.assetLocation.fields.code') }}</label>
                            <input class="form-control" type="text" name="code" id="code" value="{{ old('code', $assetLocation->code) }}" required>
                            @if($errors->has('code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetLocation.fields.code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="name_cee">{{ trans('cruds.assetLocation.fields.name_cee') }}</label>
                            <input class="form-control" type="text" name="name_cee" id="name_cee" value="{{ old('name_cee', $assetLocation->name_cee) }}" required>
                            @if($errors->has('name_cee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name_cee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetLocation.fields.name_cee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="network_id">{{ trans('cruds.assetLocation.fields.network') }}</label>
                            <select class="form-control select2" name="network_id" id="network_id" required>
                                @foreach($networks as $id => $network)
                                    <option value="{{ $id }}" {{ (old('network_id') ? old('network_id') : $assetLocation->network->id ?? '') == $id ? 'selected' : '' }}>{{ $network }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('network'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('network') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetLocation.fields.network_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="zone_id">{{ trans('cruds.assetLocation.fields.zone') }}</label>
                            <select class="form-control select2" name="zone_id" id="zone_id">
                                @foreach($zones as $id => $zone)
                                    <option value="{{ $id }}" {{ (old('zone_id') ? old('zone_id') : $assetLocation->zone->id ?? '') == $id ? 'selected' : '' }}>{{ $zone }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('zone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('zone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetLocation.fields.zone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="area_id">{{ trans('cruds.assetLocation.fields.area') }}</label>
                            <select class="form-control select2" name="area_id" id="area_id">
                                @foreach($areas as $id => $area)
                                    <option value="{{ $id }}" {{ (old('area_id') ? old('area_id') : $assetLocation->area->id ?? '') == $id ? 'selected' : '' }}>{{ $area }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('area'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('area') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetLocation.fields.area_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="province_id">{{ trans('cruds.assetLocation.fields.province') }}</label>
                            <select class="form-control select2" name="province_id" id="province_id">
                                @foreach($provinces as $id => $province)
                                    <option value="{{ $id }}" {{ (old('province_id') ? old('province_id') : $assetLocation->province->id ?? '') == $id ? 'selected' : '' }}>{{ $province }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('province'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('province') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetLocation.fields.province_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="municipality_id">{{ trans('cruds.assetLocation.fields.municipality') }}</label>
                            <select class="form-control select2" name="municipality_id" id="municipality_id">
                                @foreach($municipalities as $id => $municipality)
                                    <option value="{{ $id }}" {{ (old('municipality_id') ? old('municipality_id') : $assetLocation->municipality->id ?? '') == $id ? 'selected' : '' }}>{{ $municipality }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('municipality'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('municipality') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetLocation.fields.municipality_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="address">{{ trans('cruds.assetLocation.fields.address') }}</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ old('address', $assetLocation->address) }}">
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetLocation.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="longitude">{{ trans('cruds.assetLocation.fields.longitude') }}</label>
                            <input class="form-control" type="number" name="longitude" id="longitude" value="{{ old('longitude', $assetLocation->longitude) }}" step="0.000001">
                            @if($errors->has('longitude'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('longitude') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetLocation.fields.longitude_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="latitude">{{ trans('cruds.assetLocation.fields.latitude') }}</label>
                            <input class="form-control" type="number" name="latitude" id="latitude" value="{{ old('latitude', $assetLocation->latitude) }}" step="0.000001">
                            @if($errors->has('latitude'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('latitude') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetLocation.fields.latitude_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="altitude">{{ trans('cruds.assetLocation.fields.altitude') }}</label>
                            <input class="form-control" type="number" name="altitude" id="altitude" value="{{ old('altitude', $assetLocation->altitude) }}" step="0.01">
                            @if($errors->has('altitude'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('altitude') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetLocation.fields.altitude_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="active" value="0">
                                <input type="checkbox" name="active" id="active" value="1" {{ $assetLocation->active || old('active', 0) === 1 ? 'checked' : '' }}>
                                <label for="active">{{ trans('cruds.assetLocation.fields.active') }}</label>
                            </div>
                            @if($errors->has('active'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('active') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetLocation.fields.active_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="local_hour" value="0">
                                <input type="checkbox" name="local_hour" id="local_hour" value="1" {{ $assetLocation->local_hour || old('local_hour', 0) === 1 ? 'checked' : '' }}>
                                <label for="local_hour">{{ trans('cruds.assetLocation.fields.local_hour') }}</label>
                            </div>
                            @if($errors->has('local_hour'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('local_hour') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetLocation.fields.local_hour_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.assetLocation.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', $assetLocation->description) }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetLocation.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="start_date">{{ trans('cruds.assetLocation.fields.start_date') }}</label>
                            <input class="form-control date" type="text" name="start_date" id="start_date" value="{{ old('start_date', $assetLocation->start_date) }}">
                            @if($errors->has('start_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetLocation.fields.start_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="end_date">{{ trans('cruds.assetLocation.fields.end_date') }}</label>
                            <input class="form-control date" type="text" name="end_date" id="end_date" value="{{ old('end_date', $assetLocation->end_date) }}">
                            @if($errors->has('end_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetLocation.fields.end_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="record_id">{{ trans('cruds.assetLocation.fields.record') }}</label>
                            <select class="form-control select2" name="record_id" id="record_id">
                                @foreach($records as $id => $record)
                                    <option value="{{ $id }}" {{ (old('record_id') ? old('record_id') : $assetLocation->record->id ?? '') == $id ? 'selected' : '' }}>{{ $record }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('record'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('record') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection
