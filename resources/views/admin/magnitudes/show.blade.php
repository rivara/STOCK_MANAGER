@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.magnitude.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.magnitudes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.magnitude.fields.id') }}
                        </th>
                        <td>
                            {{ $magnitude->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.magnitude.fields.idmagnitude') }}
                        </th>
                        <td>
                            {{ $magnitude->idmagnitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.magnitude.fields.magnitude') }}
                        </th>
                        <td>
                            {{ $magnitude->magnitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.magnitude.fields.description') }}
                        </th>
                        <td>
                            {{ $magnitude->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.magnitude.fields.idunit') }}
                        </th>
                        <td>
                            {{ $magnitude->idunit->unit ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.magnitude.fields.high') }}
                        </th>
                        <td>
                            {{ $magnitude->high }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.magnitude.fields.low') }}
                        </th>
                        <td>
                            {{ $magnitude->low }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.magnitudes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection