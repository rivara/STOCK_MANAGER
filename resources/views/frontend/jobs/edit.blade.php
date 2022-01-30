@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.job.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.jobs.update", [$job->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="description">{{ trans('cruds.job.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', $job->description) }}" required>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.job.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="type_id">{{ trans('cruds.job.fields.type') }}</label>
                            <select class="form-control select2" name="type_id" id="type_id" required>
                                @foreach($types as $id => $type)
                                    <option value="{{ $id }}" {{ (old('type_id') ? old('type_id') : $job->type->id ?? '') == $id ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.job.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.job.fields.active') }}</label>
                            <select class="form-control" name="active" id="active" required>
                                <option value disabled {{ old('active', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Job::ACTIVE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('active', $job->active) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('active'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('active') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.job.fields.active_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mark_id">{{ trans('cruds.job.fields.mark') }}</label>
                            <select class="form-control select2" name="mark_id" id="mark_id">
                                @foreach($marks as $id => $mark)
                                    <option value="{{ $id }}" {{ (old('mark_id') ? old('mark_id') : $job->mark->id ?? '') == $id ? 'selected' : '' }}>{{ $mark }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('mark'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mark') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.job.fields.mark_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sample_id">{{ trans('cruds.job.fields.sample') }}</label>
                            <select class="form-control select2" name="sample_id" id="sample_id">
                                @foreach($samples as $id => $sample)
                                    <option value="{{ $id }}" {{ (old('sample_id') ? old('sample_id') : $job->sample->id ?? '') == $id ? 'selected' : '' }}>{{ $sample }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('sample'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sample') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.job.fields.sample_helper') }}</span>
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