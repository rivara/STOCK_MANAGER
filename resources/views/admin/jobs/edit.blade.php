@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.job.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.jobs.update", [$job->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.job.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $job->description) }}" required>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.job.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="type_id">{{ trans('cruds.job.fields.type') }}</label>
                <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type_id" id="type_id" required>
                    @foreach($types as $id => $type)
                        <option value="{{ $id }}" {{ (old('type_id') ? old('type_id') : $job->type->id ?? '') == $id ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.job.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.job.fields.active') }}</label>
                <select class="form-control {{ $errors->has('active') ? 'is-invalid' : '' }}" name="active" id="active" required>
                    <option value disabled {{ old('active', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Job::ACTIVE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('active', $job->active) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('active'))
                    <span class="text-danger">{{ $errors->first('active') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.job.fields.active_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mark_id">{{ trans('cruds.job.fields.mark') }}</label>
                <select class="form-control select2 {{ $errors->has('mark') ? 'is-invalid' : '' }}" name="mark_id" id="mark_id">
                    @foreach($marks as $id => $mark)
                        <option value="{{ $id }}" {{ (old('mark_id') ? old('mark_id') : $job->mark->id ?? '') == $id ? 'selected' : '' }}>{{ $mark }}</option>
                    @endforeach
                </select>
                @if($errors->has('mark'))
                    <span class="text-danger">{{ $errors->first('mark') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.job.fields.mark_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sample_id">{{ trans('cruds.job.fields.sample') }}</label>
                <select class="form-control select2 {{ $errors->has('sample') ? 'is-invalid' : '' }}" name="sample_id" id="sample_id">
                    @foreach($samples as $id => $sample)
                        <option value="{{ $id }}" {{ (old('sample_id') ? old('sample_id') : $job->sample->id ?? '') == $id ? 'selected' : '' }}>{{ $sample }}</option>
                    @endforeach
                </select>
                @if($errors->has('sample'))
                    <span class="text-danger">{{ $errors->first('sample') }}</span>
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



@endsection