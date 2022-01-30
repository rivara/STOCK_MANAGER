@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.magnitude.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.magnitudes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="idmagnitude">{{ trans('cruds.magnitude.fields.idmagnitude') }}</label>
                <input class="form-control {{ $errors->has('idmagnitude') ? 'is-invalid' : '' }}" type="number" name="idmagnitude" id="idmagnitude" value="{{ old('idmagnitude', '') }}" step="1" required>
                @if($errors->has('idmagnitude'))
                    <span class="text-danger">{{ $errors->first('idmagnitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.magnitude.fields.idmagnitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="magnitude">{{ trans('cruds.magnitude.fields.magnitude') }}</label>
                <input class="form-control {{ $errors->has('magnitude') ? 'is-invalid' : '' }}" type="text" name="magnitude" id="magnitude" value="{{ old('magnitude', '') }}" required>
                @if($errors->has('magnitude'))
                    <span class="text-danger">{{ $errors->first('magnitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.magnitude.fields.magnitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.magnitude.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.magnitude.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="idunit_id">{{ trans('cruds.magnitude.fields.idunit') }}</label>
                <select class="form-control select2 {{ $errors->has('idunit') ? 'is-invalid' : '' }}" name="idunit_id" id="idunit_id">
                    @foreach($idunits as $id => $idunit)
                        <option value="{{ $id }}" {{ old('idunit_id') == $id ? 'selected' : '' }}>{{ $idunit }}</option>
                    @endforeach
                </select>
                @if($errors->has('idunit'))
                    <span class="text-danger">{{ $errors->first('idunit') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.magnitude.fields.idunit_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="high">{{ trans('cruds.magnitude.fields.high') }}</label>
                <input class="form-control {{ $errors->has('high') ? 'is-invalid' : '' }}" type="number" name="high" id="high" value="{{ old('high', '') }}" step="1">
                @if($errors->has('high'))
                    <span class="text-danger">{{ $errors->first('high') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.magnitude.fields.high_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="low">{{ trans('cruds.magnitude.fields.low') }}</label>
                <input class="form-control {{ $errors->has('low') ? 'is-invalid' : '' }}" type="number" name="low" id="low" value="{{ old('low', '') }}" step="1">
                @if($errors->has('low'))
                    <span class="text-danger">{{ $errors->first('low') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.magnitude.fields.low_helper') }}</span>
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