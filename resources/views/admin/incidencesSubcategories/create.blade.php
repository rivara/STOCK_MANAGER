@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.incidencesSubcategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.incidences-subcategories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="incidence_category_id">{{ trans('cruds.incidencesSubcategory.fields.incidence_category') }}</label>
                <select class="form-control select2 {{ $errors->has('incidence_category') ? 'is-invalid' : '' }}" name="incidence_category_id" id="incidence_category_id" required>
                    @foreach($incidence_categories as $id => $incidence_category)
                        <option value="{{ $id }}" {{ old('incidence_category_id') == $id ? 'selected' : '' }}>{{ $incidence_category }}</option>
                    @endforeach
                </select>
                @if($errors->has('incidence_category'))
                    <span class="text-danger">{{ $errors->first('incidence_category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.incidencesSubcategory.fields.incidence_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="incidence_subcategory">{{ trans('cruds.incidencesSubcategory.fields.incidence_subcategory') }}</label>
                <input class="form-control {{ $errors->has('incidence_subcategory') ? 'is-invalid' : '' }}" type="text" name="incidence_subcategory" id="incidence_subcategory" value="{{ old('incidence_subcategory', '') }}" required>
                @if($errors->has('incidence_subcategory'))
                    <span class="text-danger">{{ $errors->first('incidence_subcategory') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.incidencesSubcategory.fields.incidence_subcategory_helper') }}</span>
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