<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Asset;
use App\Models\AssetLocation;
use App\Models\AssetStatus;
use App\Models\IncidencesCategory;
use App\Models\IncidencesSubcategory;
use App\Models\Job;
use App\Models\Period;
use App\Models\Record;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\TaskTag;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TaskController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Task::with(['tags', 'status', 'location', 'asset', 'asset_status', 'period', 'incidence_category', 'incidence_subcategory', 'assigned_to', 'record', 'job'])->select(sprintf('%s.*', (new Task)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'task_show';
                $editGate      = 'task_edit';
                $deleteGate    = 'task_delete';
                $crudRoutePart = 'tasks';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('tag', function ($row) {
                $labels = [];

                foreach ($row->tags as $tag) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $tag->name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->addColumn('location_name', function ($row) {
                return $row->location ? $row->location->name : '';
            });

            $table->addColumn('asset_name', function ($row) {
                return $row->asset ? $row->asset->name : '';
            });

            $table->editColumn('asset.name', function ($row) {
                return $row->asset ? (is_string($row->asset) ? $row->asset : $row->asset->name) : '';
            });

            $table->addColumn('asset_status_name', function ($row) {
                return $row->asset_status ? $row->asset_status->name : '';
            });

            $table->addColumn('period_period', function ($row) {
                return $row->period ? $row->period->period : '';
            });

            $table->addColumn('incidence_category_incidence_category', function ($row) {
                return $row->incidence_category ? $row->incidence_category->incidence_category : '';
            });

            $table->addColumn('incidence_subcategory_incidence_subcategory', function ($row) {
                return $row->incidence_subcategory ? $row->incidence_subcategory->incidence_subcategory : '';
            });

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });

            $table->editColumn('lost_data', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->lost_data ? 'checked' : null) . '>';
            });
            $table->addColumn('assigned_to_name', function ($row) {
                return $row->assigned_to ? $row->assigned_to->name : '';
            });

            $table->editColumn('attachment', function ($row) {
                return $row->attachment ? '<a href="' . $row->attachment->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : "";
            });
            $table->addColumn('record_idrecord', function ($row) {
                return $row->record ? $row->record->idrecord : '';
            });

            $table->addColumn('job_idjob', function ($row) {
                return $row->job ? $row->job->idjob : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'tag', 'status', 'location', 'asset', 'asset_status', 'period', 'incidence_category', 'incidence_subcategory', 'lost_data', 'assigned_to', 'attachment', 'record', 'job']);

            return $table->make(true);
        }

        $task_tags                = TaskTag::get();
        $task_statuses            = TaskStatus::get();
        $asset_locations          = AssetLocation::get();
        $assets                   = Asset::get();
        $asset_statuses           = AssetStatus::get();
        $periods                  = Period::get();
        $incidences_categories    = IncidencesCategory::get();
        $incidences_subcategories = IncidencesSubcategory::get();
        $users                    = User::get();
        $records               = Record::get();
        $jobs                     = Job::get();

        return view('admin.tasks.index', compact('task_tags', 'task_statuses', 'asset_locations', 'assets', 'asset_statuses', 'periods', 'incidences_categories', 'incidences_subcategories', 'users', 'records', 'jobs'));
    }

    public function create()
    {
        abort_if(Gate::denies('task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tags = TaskTag::all()->pluck('name', 'id');

        $statuses = TaskStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = AssetLocation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assets = Asset::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $asset_statuses = AssetStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $periods = Period::all()->pluck('period', 'id')->prepend(trans('global.pleaseSelect'), '');

        $incidence_categories = IncidencesCategory::all()->pluck('incidence_category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $incidence_subcategories = IncidencesSubcategory::all()->pluck('incidence_subcategory', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $records = Record::all()->pluck('idrecord', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jobs = Job::all()->pluck('idjob', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tasks.create', compact('tags', 'statuses', 'locations', 'assets', 'asset_statuses', 'periods', 'incidence_categories', 'incidence_subcategories', 'assigned_tos', 'records', 'jobs'));
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->all());
        $task->tags()->sync($request->input('tags', []));

        if ($request->input('attachment', false)) {
            $task->addMedia(storage_path('tmp/uploads/' . $request->input('attachment')))->toMediaCollection('attachment');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $task->id]);
        }

        return redirect()->route('admin.tasks.index');
    }

    public function edit(Task $task)
    {
        abort_if(Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tags = TaskTag::all()->pluck('name', 'id');

        $statuses = TaskStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = AssetLocation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assets = Asset::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $asset_statuses = AssetStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $periods = Period::all()->pluck('period', 'id')->prepend(trans('global.pleaseSelect'), '');

        $incidence_categories = IncidencesCategory::all()->pluck('incidence_category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $incidence_subcategories = IncidencesSubcategory::all()->pluck('incidence_subcategory', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $records = Record::all()->pluck('idrecord', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jobs = Job::all()->pluck('idjob', 'id')->prepend(trans('global.pleaseSelect'), '');

        //$task->load('tags', 'status', 'location', 'asset', 'asset_status', 'period', 'incidence_category', 'incidence_subcategory', 'assigned_to', 'record', 'job');
        $start_date =  date("d/m/Y", strtotime($task->start_date));
        $end_date =    date("d/m/Y", strtotime($task->end_date));
        $due_date =    date("d/m/Y", strtotime($task->due_date));

        if ( $due_date =='01/01/1970'){
            $due_date=null;
        }

        return view('admin.tasks.edit', compact('tags', 'statuses', 'locations', 'assets', 'asset_statuses', 'periods', 'incidence_categories', 'incidence_subcategories', 'assigned_tos', 'records', 'jobs', 'task','start_date','due_date','end_date'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->all());
        $task->tags()->sync($request->input('tags', []));

        if ($request->input('attachment', false)) {
            if (!$task->attachment || $request->input('attachment') !== $task->attachment->file_name) {
                if ($task->attachment) {
                    $task->attachment->delete();
                }

                $task->addMedia(storage_path('tmp/uploads/' . $request->input('attachment')))->toMediaCollection('attachment');
            }
        } elseif ($task->attachment) {
            $task->attachment->delete();
        }

        return redirect()->route('admin.tasks.index');
    }

    public function show(Task $task)
    {
        abort_if(Gate::denies('task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->load('tags', 'status', 'location', 'asset', 'asset_status', 'period', 'incidence_category', 'incidence_subcategory', 'assigned_to', 'record', 'job');

        return view('admin.tasks.show', compact('task'));
    }

    public function destroy(Task $task)
    {
        abort_if(Gate::denies('task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaskRequest $request)
    {
        Task::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('task_create') && Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Task();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
