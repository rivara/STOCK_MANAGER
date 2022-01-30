@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.network.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.networks.update", [$network->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="network">{{ trans('cruds.network.fields.network') }}</label>
                <input class="form-control {{ $errors->has('network') ? 'is-invalid' : '' }}" type="text" name="network" id="network" value="{{ old('network', $network->network) }}" required>
                @if($errors->has('network'))
                    <span class="text-danger">{{ $errors->first('network') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.network.fields.network_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.network.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $network->description) }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.network.fields.description_helper') }}</span>
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