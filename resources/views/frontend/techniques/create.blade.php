@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.technique.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.techniques.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="idtechnique">{{ trans('cruds.technique.fields.idtechnique') }}</label>
                            <input class="form-control" type="number" name="idtechnique" id="idtechnique" value="{{ old('idtechnique', '') }}" step="1" required>
                            @if($errors->has('idtechnique'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('idtechnique') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.technique.fields.idtechnique_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="technique">{{ trans('cruds.technique.fields.technique') }}</label>
                            <input class="form-control" type="text" name="technique" id="technique" value="{{ old('technique', '') }}" required>
                            @if($errors->has('technique'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('technique') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.technique.fields.technique_helper') }}</span>
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