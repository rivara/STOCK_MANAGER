<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAssetRequest;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\AssetSubCategory;
use App\Models\AssetLocation;
use App\Models\AssetStatus;
use App\Models\Mark;
use App\Models\Record;
use App\Models\Sample;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AssetController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('asset_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Asset::with(['category', 'status', 'location', 'assigned_to', 'mark', 'sample', 'record'])->select(sprintf('%s.*', (new Asset)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'asset_show';
                $editGate      = 'asset_edit';
                $deleteGate    = 'asset_delete';
                $crudRoutePart = 'assets';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->addColumn('category_name', function ($row) {
                return $row->category ? $row->category->name : '';
            });

            $table->editColumn('serial_number', function ($row) {
                return $row->serial_number ? $row->serial_number : "";
            });

            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->addColumn('location_name', function ($row) {
                return $row->location ? $row->location->name : '';
            });

            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : "";
            });
            $table->editColumn('regulations', function ($row) {
                return $row->regulations ? $row->regulations : "";
            });
            $table->addColumn('mark_mark', function ($row) {
                return $row->mark ? $row->mark->mark : '';
            });

            $table->addColumn('sample_sample', function ($row) {
                return $row->sample ? $row->sample->sample : '';
            });

            $table->addColumn('record_idrecord', function ($row) {
                return $row->record ? $row->record->idrecord : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'category', 'status', 'location', 'mark', 'sample', 'record']);

            return $table->make(true);
        }

        $asset_categories = AssetCategory::get();
        $asset_subcategories = AssetSubCategory::get();
        $asset_statuses   = AssetStatus::get();
        $asset_locations  = AssetLocation::get();
        $users            = User::get();
        $marks            = Mark::get();
        $samples          = Sample::get();
        $records          = Record::get();

        return view('admin.assets.index', compact('asset_categories', 'asset_statuses', 'asset_locations', 'users', 'marks', 'samples', 'records'));
    }

    public function create()
    {
        abort_if(Gate::denies('asset_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = AssetCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subcategories = AssetSubCategory::all()->pluck('asset_subcategory', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = AssetStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = AssetLocation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $marks = Mark::all()->pluck('mark', 'id')->prepend(trans('global.pleaseSelect'), '');

        $samples = Sample::all()->pluck('sample', 'id')->prepend(trans('global.pleaseSelect'), '');

        $records = Record::all()->pluck('idrecord', 'id')->prepend(trans('global.pleaseSelect'), '');
        //smi 20210217 error porque se pasaba a la vista $record en lugar de $records
        return view('admin.assets.create', compact('categories','subcategories', 'statuses', 'locations', 'marks', 'samples', 'records'));

        //return view('admin.assets.create', compact('categories', 'statuses', 'locations', 'marks', 'samples', 'record'));
    }

    public function store(StoreAssetRequest $request)
    {
        $asset = Asset::create($request->all());
        foreach ($request->input('photos', []) as $file) {
            $asset->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $asset->id]);
        }

        return redirect()->route('admin.assets.index');
    }

    public function edit(Asset $asset)
    {
        abort_if(Gate::denies('asset_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = AssetCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = AssetStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = AssetLocation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $marks = Mark::all()->pluck('mark', 'id')->prepend(trans('global.pleaseSelect'), '');

        $samples = Sample::all()->pluck('sample', 'id')->prepend(trans('global.pleaseSelect'), '');

        $record = Record::all()->pluck('idrecord', 'id')->prepend(trans('global.pleaseSelect'), '');

        $asset->load('category', 'status', 'location', 'assigned_to', 'mark', 'sample', 'record');

        //smi 20210217 error porque se pasaba a la vista $records en lugar de $record
        return view('admin.assets.edit', compact('categories', 'statuses', 'locations', 'marks', 'samples', 'record', 'asset'));
      //  return view('admin.assets.edit', compact('categories', 'statuses', 'locations', 'marks', 'samples', 'records', 'asset'));
    }

    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        $asset->update($request->all());

        if (count($asset->photos) > 0) {
            foreach ($asset->photos as $media) {
                if (!in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }

        $media = $asset->photos->pluck('file_name')->toArray();

        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $asset->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.assets.index');
    }

    public function show(Asset $asset)
    {
        abort_if(Gate::denies('asset_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asset->load('category', 'status', 'location', 'assigned_to', 'mark', 'sample', 'record');

        return view('admin.assets.show', compact('asset'));
    }

    public function destroy(Asset $asset)
    {
        abort_if(Gate::denies('asset_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asset->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssetRequest $request)
    {
        Asset::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('asset_create') && Gate::denies('asset_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Asset();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
