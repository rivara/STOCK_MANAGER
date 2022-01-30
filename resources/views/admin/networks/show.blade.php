@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.network.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.networks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.network.fields.id') }}
                        </th>
                        <td>
                            {{ $network->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.network.fields.network') }}
                        </th>
                        <td>
                            {{ $network->network }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.network.fields.description') }}
                        </th>
                        <td>
                            {{ $network->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.networks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection