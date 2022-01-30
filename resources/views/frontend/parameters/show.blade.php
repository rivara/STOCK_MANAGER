@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.parameter.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.parameters.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.parameter.fields.idmagnitude') }}
                                    </th>
                                    <td>
                                        {{ $parameter->idmagnitude->magnitude ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.parameter.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $parameter->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.parameter.fields.technique') }}
                                    </th>
                                    <td>
                                        {{ $parameter->technique->technique ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.parameter.fields.unit') }}
                                    </th>
                                    <td>
                                        {{ $parameter->unit->unit ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.parameter.fields.calculation') }}
                                    </th>
                                    <td>
                                        {{ $parameter->calculation->calculation ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.parameter.fields.active') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $parameter->active ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.parameter.fields.period') }}
                                    </th>
                                    <td>
                                        {{ $parameter->period }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.parameter.fields.decimals') }}
                                    </th>
                                    <td>
                                        {{ $parameter->decimals }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.parameter.fields.max_value') }}
                                    </th>
                                    <td>
                                        {{ $parameter->max_value }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.parameter.fields.min_value') }}
                                    </th>
                                    <td>
                                        {{ $parameter->min_value }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.parameter.fields.location') }}
                                    </th>
                                    <td>
                                        {{ $parameter->location->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.parameter.fields.asset') }}
                                    </th>
                                    <td>
                                        {{ $parameter->asset->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.parameter.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $parameter->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.parameter.fields.end_date') }}
                                    </th>
                                    <td>
                                        {{ $parameter->end_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.parameter.fields.formula') }}
                                    </th>
                                    <td>
                                        {{ $parameter->formula }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.parameter.fields.alarm') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $parameter->alarm ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.parameters.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection