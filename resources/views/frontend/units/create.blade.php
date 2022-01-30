@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.unit.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.units.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="unit">{{ trans('cruds.unit.fields.unit') }}</label>
                            <input class="form-control" type="text" name="unit" id="unit" value="{{ old('unit', '') }}" required>
                            @if($errors->has('unit'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('unit') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.unit.fields.unit_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.unit.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', '') }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection