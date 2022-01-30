@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.sample.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.samples.update", [$sample->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="mark_id">{{ trans('cruds.sample.fields.mark') }}</label>
                            <select class="form-control select2" name="mark_id" id="mark_id" required>
                                @foreach($marks as $id => $mark)
                                    <option value="{{ $id }}" {{ (old('mark_id') ? old('mark_id') : $sample->mark->id ?? '') == $id ? 'selected' : '' }}>{{ $mark }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('mark'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mark') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.sample.fields.mark_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="sample">{{ trans('cruds.sample.fields.sample') }}</label>
                            <input class="form-control" type="text" name="sample" id="sample" value="{{ old('sample', $sample->sample) }}" required>
                            @if($errors->has('sample'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sample') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.sample.fields.sample_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.sample.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', $sample->description) }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.sample.fields.description_helper') }}</span>
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