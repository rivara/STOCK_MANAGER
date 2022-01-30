@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.technique.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.techniques.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="idtechnique">{{ trans('cruds.technique.fields.idtechnique') }}</label>
                <input class="form-control {{ $errors->has('idtechnique') ? 'is-invalid' : '' }}" type="number" name="idtechnique" id="idtechnique" value="{{ old('idtechnique', '') }}" step="1" required>
                @if($errors->has('idtechnique'))
                    <span class="text-danger">{{ $errors->first('idtechnique') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.technique.fields.idtechnique_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="technique">{{ trans('cruds.technique.fields.technique') }}</label>
                <input class="form-control {{ $errors->has('technique') ? 'is-invalid' : '' }}" type="text" name="technique" id="technique" value="{{ old('technique', '') }}" required>
                @if($errors->has('technique'))
                    <span class="text-danger">{{ $errors->first('technique') }}</span>
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



@endsection