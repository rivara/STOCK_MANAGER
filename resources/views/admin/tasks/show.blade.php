@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.task.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tasks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.tag') }}
                        </th>
                        <td>
                            @foreach($task->tags as $key => $tag)
                                <span class="label label-info">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.status') }}
                        </th>
                        <td>
                            {{ $task->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.location') }}
                        </th>
                        <td>
                            {{ $task->location->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.asset') }}
                        </th>
                        <td>
                            {{ $task->asset->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.asset_status') }}
                        </th>
                        <td>
                            {{ $task->asset_status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.period') }}
                        </th>
                        <td>
                            {{ $task->period->period ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.incidence_category') }}
                        </th>
                        <td>
                            {{ $task->incidence_category->incidence_category ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.incidence_subcategory') }}
                        </th>
                        <td>
                            {{ $task->incidence_subcategory->incidence_subcategory ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.description') }}
                        </th>
                        <td>
                            {{ $task->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.start_date') }}
                        </th>
                        <td>
                            {{ $task->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.due_date') }}
                        </th>
                        <td>
                            {{ $task->due_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.end_date') }}
                        </th>
                        <td>
                            {{ $task->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.lost_data') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $task->lost_data ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.assigned_to') }}
                        </th>
                        <td>
                            {{ $task->assigned_to->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.attachment') }}
                        </th>
                        <td>
                            @if($task->attachment)
                                <a href="{{ $task->attachment->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.link') }}
                        </th>
                        <td>
                            {{ $task->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.record') }}
                        </th>
                        <td>
                            {{ $task->record->idrecord ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.job') }}
                        </th>
                        <td>
                            {{ $task->job->idjob ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tasks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
