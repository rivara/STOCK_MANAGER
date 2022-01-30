@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.assetLocation.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.asset-locations.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $assetLocation->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.code') }}
                                    </th>
                                    <td>
                                        {{ $assetLocation->code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.name_cee') }}
                                    </th>
                                    <td>
                                        {{ $assetLocation->name_cee }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.network') }}
                                    </th>
                                    <td>
                                        {{ $assetLocation->network->network ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.zone') }}
                                    </th>
                                    <td>
                                        {{ $assetLocation->zone->zone ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.area') }}
                                    </th>
                                    <td>
                                        {{ $assetLocation->area->area ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.province') }}
                                    </th>
                                    <td>
                                        {{ $assetLocation->province->province ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.municipality') }}
                                    </th>
                                    <td>
                                        {{ $assetLocation->municipality->municipality ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.address') }}
                                    </th>
                                    <td>
                                        {{ $assetLocation->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.longitude') }}
                                    </th>
                                    <td>
                                        {{ $assetLocation->longitude }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.latitude') }}
                                    </th>
                                    <td>
                                        {{ $assetLocation->latitude }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.altitude') }}
                                    </th>
                                    <td>
                                        {{ $assetLocation->altitude }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.active') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $assetLocation->active ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.local_hour') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $assetLocation->local_hour ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $assetLocation->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $assetLocation->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.end_date') }}
                                    </th>
                                    <td>
                                        {{ $assetLocation->end_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.record') }}
                                    </th>
                                    <td>
                                        {{ $assetLocation->record->idrecord ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.asset-locations.index') }}">
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
