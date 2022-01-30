@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.magnitude.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.magnitudes.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="idmagnitude">{{ trans('cruds.magnitude.fields.idmagnitude') }}</label>
                            <input class="form-control" type="number" name="idmagnitude" id="idmagnitude" value="{{ old('idmagnitude', '') }}" step="1" required>
                            @if($errors->has('idmagnitude'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('idmagnitude') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.magnitude.fields.idmagnitude_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="magnitude">{{ trans('cruds.magnitude.fields.magnitude') }}</label>
                            <input class="form-control" type="text" name="magnitude" id="magnitude" value="{{ old('magnitude', '') }}" required>
                            @if($errors->has('magnitude'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('magnitude') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.magnitude.fields.magnitude_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.magnitude.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', '') }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.magnitude.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="idunit_id">{{ trans('cruds.magnitude.fields.idunit') }}</label>
                            <select class="form-control select2" name="idunit_id" id="idunit_id">
                                @foreach($idunits as $id => $idunit)
                                    <option value="{{ $id }}" {{ old('idunit_id') == $id ? 'selected' : '' }}>{{ $idunit }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('idunit'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('idunit') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.magnitude.fields.idunit_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="high">{{ trans('cruds.magnitude.fields.high') }}</label>
                            <input class="form-control" type="number" name="high" id="high" value="{{ old('high', '') }}" step="1">
                            @if($errors->has('high'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('high') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.magnitude.fields.high_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="low">{{ trans('cruds.magnitude.fields.low') }}</label>
                            <input class="form-control" type="number" name="low" id="low" value="{{ old('low', '') }}" step="1">
                            @if($errors->has('low'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('low') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection