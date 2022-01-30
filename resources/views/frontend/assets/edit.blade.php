@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.asset.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.assets.update", [$asset->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.asset.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $asset->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="category_id">{{ trans('cruds.asset.fields.category') }}</label>
                            <select class="form-control select2" name="category_id" id="category_id" required>
                                @foreach($categories as $id => $category)
                                    <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $asset->category->id ?? '') == $id ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="serial_number">{{ trans('cruds.asset.fields.serial_number') }}</label>
                            <input class="form-control" type="text" name="serial_number" id="serial_number" value="{{ old('serial_number', $asset->serial_number) }}">
                            @if($errors->has('serial_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('serial_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.serial_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="start_date">{{ trans('cruds.asset.fields.start_date') }}</label>
                            <input class="form-control date" type="text" name="start_date" id="start_date" value="{{ old('start_date', $asset->start_date) }}">
                            @if($errors->has('start_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.start_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="end_date">{{ trans('cruds.asset.fields.end_date') }}</label>
                            <input class="form-control date" type="text" name="end_date" id="end_date" value="{{ old('end_date', $asset->end_date) }}">
                            @if($errors->has('end_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.end_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="status_id">{{ trans('cruds.asset.fields.status') }}</label>
                            <select class="form-control select2" name="status_id" id="status_id" required>
                                @foreach($statuses as $id => $status)
                                    <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $asset->status->id ?? '') == $id ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="location_id">{{ trans('cruds.asset.fields.location') }}</label>
                            <select class="form-control select2" name="location_id" id="location_id" required>
                                @foreach($locations as $id => $location)
                                    <option value="{{ $id }}" {{ (old('location_id') ? old('location_id') : $asset->location->id ?? '') == $id ? 'selected' : '' }}>{{ $location }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('location'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('location') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.location_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.asset.fields.notes') }}</label>
                            <textarea class="form-control" name="notes" id="notes">{{ old('notes', $asset->notes) }}</textarea>
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="regulations">{{ trans('cruds.asset.fields.regulations') }}</label>
                            <input class="form-control" type="text" name="regulations" id="regulations" value="{{ old('regulations', $asset->regulations) }}">
                            @if($errors->has('regulations'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('regulations') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.regulations_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mark_id">{{ trans('cruds.asset.fields.mark') }}</label>
                            <select class="form-control select2" name="mark_id" id="mark_id">
                                @foreach($marks as $id => $mark)
                                    <option value="{{ $id }}" {{ (old('mark_id') ? old('mark_id') : $asset->mark->id ?? '') == $id ? 'selected' : '' }}>{{ $mark }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('mark'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mark') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.mark_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sample_id">{{ trans('cruds.asset.fields.sample') }}</label>
                            <select class="form-control select2" name="sample_id" id="sample_id">
                                @foreach($samples as $id => $sample)
                                    <option value="{{ $id }}" {{ (old('sample_id') ? old('sample_id') : $asset->sample->id ?? '') == $id ? 'selected' : '' }}>{{ $sample }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('sample'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sample') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.sample_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="record_id">{{ trans('cruds.asset.fields.record') }}</label>
                            <select class="form-control select2" name="record_id" id="record_id">
                                @foreach($records as $id => $record)
                                    <option value="{{ $id }}" {{ (old('record_id') ? old('record_id') : $asset->record->id ?? '') == $id ? 'selected' : '' }}>{{ $record }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('record'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('record') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.record_helper') }}</span>
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
