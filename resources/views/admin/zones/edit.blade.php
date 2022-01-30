@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.zone.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.zones.update", [$zone->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="network_id">{{ trans('cruds.zone.fields.network') }}</label>
                <select class="form-control select2 {{ $errors->has('network') ? 'is-invalid' : '' }}" name="network_id" id="network_id" required>
                    @foreach($networks as $id => $network)
                        <option value="{{ $id }}" {{ (old('network_id') ? old('network_id') : $zone->network->id ?? '') == $id ? 'selected' : '' }}>{{ $network }}</option>
                    @endforeach
                </select>
                @if($errors->has('network'))
                    <span class="text-danger">{{ $errors->first('network') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.zone.fields.network_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="zone">{{ trans('cruds.zone.fields.zone') }}</label>
                <input class="form-control {{ $errors->has('zone') ? 'is-invalid' : '' }}" type="text" name="zone" id="zone" value="{{ old('zone', $zone->zone) }}" required>
                @if($errors->has('zone'))
                    <span class="text-danger">{{ $errors->first('zone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.zone.fields.zone_helper') }}</span>
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