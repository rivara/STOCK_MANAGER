@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.network.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.networks.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="network">{{ trans('cruds.network.fields.network') }}</label>
                            <input class="form-control" type="text" name="network" id="network" value="{{ old('network', '') }}" required>
                            @if($errors->has('network'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('network') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.network.fields.network_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.network.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', '') }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection