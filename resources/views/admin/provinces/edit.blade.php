@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.province.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.provinces.update", [$province->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="province">{{ trans('cruds.province.fields.province') }}</label>
                <input class="form-control {{ $errors->has('province') ? 'is-invalid' : '' }}" type="text" name="province" id="province" value="{{ old('province', $province->province) }}" required>
                @if($errors->has('province'))
                    <span class="text-danger">{{ $errors->first('province') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.province.fields.province_helper') }}</span>
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