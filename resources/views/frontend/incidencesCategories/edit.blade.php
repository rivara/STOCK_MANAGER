@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.incidencesCategory.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.incidences-categories.update", [$incidencesCategory->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="incidence_category">{{ trans('cruds.incidencesCategory.fields.incidence_category') }}</label>
                            <input class="form-control" type="text" name="incidence_category" id="incidence_category" value="{{ old('incidence_category', $incidencesCategory->incidence_category) }}" required>
                            @if($errors->has('incidence_category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('incidence_category') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection