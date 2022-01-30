@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.asset.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.assets.update", [$asset->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.asset.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $asset->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.asset.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $asset->category->id ?? '') == $id ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <span class="text-danger">{{ $errors->first('category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="serial_number">{{ trans('cruds.asset.fields.serial_number') }}</label>
                <input class="form-control {{ $errors->has('serial_number') ? 'is-invalid' : '' }}" type="text" name="serial_number" id="serial_number" value="{{ old('serial_number', $asset->serial_number) }}">
                @if($errors->has('serial_number'))
                    <span class="text-danger">{{ $errors->first('serial_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.serial_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_date">{{ trans('cruds.asset.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date', $asset->start_date) }}">
                @if($errors->has('start_date'))
                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_date">{{ trans('cruds.asset.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date', $asset->end_date) }}">
                @if($errors->has('end_date'))
                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.asset.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $status)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $asset->status->id ?? '') == $id ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="location_id">{{ trans('cruds.asset.fields.location') }}</label>
                <select class="form-control select2 {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location_id" id="location_id" required>
                    @foreach($locations as $id => $location)
                        <option value="{{ $id }}" {{ (old('location_id') ? old('location_id') : $asset->location->id ?? '') == $id ? 'selected' : '' }}>{{ $location }}</option>
                    @endforeach
                </select>
                @if($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.asset.fields.notes') }}</label>
                <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{{ old('notes', $asset->notes) }}</textarea>
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="regulations">{{ trans('cruds.asset.fields.regulations') }}</label>
                <input class="form-control {{ $errors->has('regulations') ? 'is-invalid' : '' }}" type="text" name="regulations" id="regulations" value="{{ old('regulations', $asset->regulations) }}">
                @if($errors->has('regulations'))
                    <span class="text-danger">{{ $errors->first('regulations') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.regulations_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mark_id">{{ trans('cruds.asset.fields.mark') }}</label>
                <select class="form-control select2 {{ $errors->has('mark') ? 'is-invalid' : '' }}" name="mark_id" id="mark_id">
                    @foreach($marks as $id => $mark)
                        <option value="{{ $id }}" {{ (old('mark_id') ? old('mark_id') : $asset->mark->id ?? '') == $id ? 'selected' : '' }}>{{ $mark }}</option>
                    @endforeach
                </select>
                @if($errors->has('mark'))
                    <span class="text-danger">{{ $errors->first('mark') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.mark_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sample_id">{{ trans('cruds.asset.fields.sample') }}</label>
                <select class="form-control select2 {{ $errors->has('sample') ? 'is-invalid' : '' }}" name="sample_id" id="sample_id">
                    @foreach($samples as $id => $sample)
                        <option value="{{ $id }}" {{ (old('sample_id') ? old('sample_id') : $asset->sample->id ?? '') == $id ? 'selected' : '' }}>{{ $sample }}</option>
                    @endforeach
                </select>
                @if($errors->has('sample'))
                    <span class="text-danger">{{ $errors->first('sample') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.sample_helper') }}</span>
            </div>

            <!--<div class="form-group">
                <label for="record_id">{ trans('cruds.asset.fields.record') }}</label>
                <select class="form-control select2 { $errors->has('record') ? 'is-invalid' : '' }}" name="record_id" id="record_id">
                    foreach($records as $id => $record)
                        <option value="{ $id }}" { (old('record_id') ? old('record_id') : $asset->record->id ?? '') == $id ? 'selected' : '' }}>{ $record }}</option>
                    endforeach
                </select>
                if($errors->has('record'))
                    <span class="text-danger">{ $errors->first('record') }}</span>
                endif
                <span class="help-block">{{ trans('cruds.asset.fields.record_helper') }}</span>
            </div>-->
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
