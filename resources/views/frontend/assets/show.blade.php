@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.asset.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.assets.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $asset->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.category') }}
                                    </th>
                                    <td>
                                        {{ $asset->category->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.serial_number') }}
                                    </th>
                                    <td>
                                        {{ $asset->serial_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $asset->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.end_date') }}
                                    </th>
                                    <td>
                                        {{ $asset->end_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.status') }}
                                    </th>
                                    <td>
                                        {{ $asset->status->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.location') }}
                                    </th>
                                    <td>
                                        {{ $asset->location->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.notes') }}
                                    </th>
                                    <td>
                                        {{ $asset->notes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.regulations') }}
                                    </th>
                                    <td>
                                        {{ $asset->regulations }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.mark') }}
                                    </th>
                                    <td>
                                        {{ $asset->mark->mark ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.sample') }}
                                    </th>
                                    <td>
                                        {{ $asset->sample->sample ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.record') }}
                                    </th>
                                    <td>
                                        {{ $asset->record->idrecord ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.assets.index') }}">
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
