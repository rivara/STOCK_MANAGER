@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.mark.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.marks.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="mark">{{ trans('cruds.mark.fields.mark') }}</label>
                            <input class="form-control" type="text" name="mark" id="mark" value="{{ old('mark', '') }}" required>
                            @if($errors->has('mark'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mark') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mark.fields.mark_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.mark.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', '') }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mark.fields.description_helper') }}</span>
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