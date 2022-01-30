@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.incidencesCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.incidences-categories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="incidence_category">{{ trans('cruds.incidencesCategory.fields.incidence_category') }}</label>
                <input class="form-control {{ $errors->has('incidence_category') ? 'is-invalid' : '' }}" type="text" name="incidence_category" id="incidence_category" value="{{ old('incidence_category', '') }}" required>
                @if($errors->has('incidence_category'))
                    <span class="text-danger">{{ $errors->first('incidence_category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.incidencesCategory.fields.incidence_category_helper') }}</span>
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