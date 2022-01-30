@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.municipality.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.municipalities.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="province_id">{{ trans('cruds.municipality.fields.province') }}</label>
                            <select class="form-control select2" name="province_id" id="province_id" required>
                                @foreach($provinces as $id => $province)
                                    <option value="{{ $id }}" {{ old('province_id') == $id ? 'selected' : '' }}>{{ $province }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('province'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('province') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.municipality.fields.province_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="municipality">{{ trans('cruds.municipality.fields.municipality') }}</label>
                            <input class="form-control" type="text" name="municipality" id="municipality" value="{{ old('municipality', '') }}" required>
                            @if($errors->has('municipality'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('municipality') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.municipality.fields.municipality_helper') }}</span>
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