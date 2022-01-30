@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.calculation.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.calculations.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="calculation">{{ trans('cruds.calculation.fields.calculation') }}</label>
                            <input class="form-control" type="text" name="calculation" id="calculation" value="{{ old('calculation', '') }}" required>
                            @if($errors->has('calculation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('calculation') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection