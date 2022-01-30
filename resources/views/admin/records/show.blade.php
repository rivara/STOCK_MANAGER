@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.record.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.records.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.record.fields.id') }}
                        </th>
                        <td>
                            {{ $record->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.record.fields.idrecord') }}
                        </th>
                        <td>
                            {{ $record->idrecord }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.record.fields.description') }}
                        </th>
                        <td>
                            {{ $record->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.record.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Record::TYPE_SELECT[$record->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.record.fields.url') }}
                        </th>
                        <td>
                            {{ $record->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.record.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Record::STATUS_RADIO[$record->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.record.fields.created_by') }}
                        </th>
                        <td>
                            {{ $record->created_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.record.fields.attached') }}
                        </th>
                        <td>
                            @foreach($record->attached as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.records.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
