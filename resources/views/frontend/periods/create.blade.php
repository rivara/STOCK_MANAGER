@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.period.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.periods.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="period">{{ trans('cruds.period.fields.period') }}</label>
                            <input class="form-control" type="text" name="period" id="period" value="{{ old('period', '') }}" required>
                            @if($errors->has('period'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('period') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.period.fields.period_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="value">{{ trans('cruds.period.fields.value') }}</label>
                            <input class="form-control" type="number" name="value" id="value" value="{{ old('value', '0') }}" step="1" required>
                            @if($errors->has('value'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('value') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection