@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.municipality.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.municipalities.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="province_id">{{ trans('cruds.municipality.fields.province') }}</label>
                <select class="form-control select2 {{ $errors->has('province') ? 'is-invalid' : '' }}" name="province_id" id="province_id" required>
                    @foreach($provinces as $id => $province)
                        <option value="{{ $id }}" {{ old('province_id') == $id ? 'selected' : '' }}>{{ $province }}</option>
                    @endforeach
                </select>
                @if($errors->has('province'))
                    <span class="text-danger">{{ $errors->first('province') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.municipality.fields.province_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="municipality">{{ trans('cruds.municipality.fields.municipality') }}</label>
                <input class="form-control {{ $errors->has('municipality') ? 'is-invalid' : '' }}" type="text" name="municipality" id="municipality" value="{{ old('municipality', '') }}" required>
                @if($errors->has('municipality'))
                    <span class="text-danger">{{ $errors->first('municipality') }}</span>
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



@endsection