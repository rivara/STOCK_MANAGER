<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAssetLocationRequest;
use App\Http\Requests\StoreAssetLocationRequest;
use App\Http\Requests\UpdateAssetLocationRequest;
use App\Models\Area;
use App\Models\AssetLocation;
use App\Models\Municipality;
use App\Models\Network;
use App\Models\Province;
use App\Models\Record;
use App\Models\Zone;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AssetLocationController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('asset_location_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AssetLocation::with(['network', 'zone', 'area', 'province', 'municipality', 'record'])->select(sprintf('%s.*', (new AssetLocation)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'asset_location_show';
                $editGate      = 'asset_location_edit';
                $deleteGate    = 'asset_location_delete';
                $crudRoutePart = 'asset-locations';

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
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : "";
            });
            $table->editColumn('name_cee', function ($row) {
                return $row->name_cee ? $row->name_cee : "";
            });
            $table->addColumn('network_network', function ($row) {
                return $row->network ? $row->network->network : '';
            });

            $table->addColumn('zone_zone', function ($row) {
                return $row->zone ? $row->zone->zone : '';
            });

            $table->addColumn('area_area', function ($row) {
                return $row->area ? $row->area->area : '';
            });

            $table->addColumn('province_province', function ($row) {
                return $row->province ? $row->province->province : '';
            });

            $table->addColumn('municipality_municipality', function ($row) {
                return $row->municipality ? $row->municipality->municipality : '';
            });

            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : "";
            });
            $table->editColumn('longitude', function ($row) {
                return $row->longitude ? $row->longitude : "";
            });
            $table->editColumn('latitude', function ($row) {
                return $row->latitude ? $row->latitude : "";
            });
            $table->editColumn('altitude', function ($row) {
                return $row->altitude ? $row->altitude : "";
            });
            $table->editColumn('active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->active ? 'checked' : null) . '>';
            });
            $table->editColumn('local_hour', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->local_hour ? 'checked' : null) . '>';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });

            $table->addColumn('record_idrecord', function ($row) {
                return $row->record ? $row->record->idrecord : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'network', 'zone', 'area', 'province', 'municipality', 'active', 'local_hour', 'record']);

            return $table->make(true);
        }

        $networks       = Network::get();
        $zones          = Zone::get();
        $areas          = Area::get();
        $provinces      = Province::get();
        $municipalities = Municipality::get();
        $records        = null;//Records::get();

        return view('admin.assetLocations.index', compact('networks', 'zones', 'areas', 'provinces', 'municipalities', 'records'));
    }

    public function create()
    {
        abort_if(Gate::denies('asset_location_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $networks = Network::all()->pluck('network', 'id')->prepend(trans('global.pleaseSelect'), '');

        $zones = Zone::all()->pluck('zone', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areas = Area::all()->pluck('area', 'id')->prepend(trans('global.pleaseSelect'), '');

        $provinces = Province::all()->pluck('province', 'id')->prepend(trans('global.pleaseSelect'), '');

        $municipalities = Municipality::all()->pluck('municipality', 'id')->prepend(trans('global.pleaseSelect'), '');

     //   $records = Records::all()->pluck('idrecord', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.assetLocations.create', compact('networks', 'zones', 'areas', 'provinces', 'municipalities', 'records'));
    }

    public function store(StoreAssetLocationRequest $request)
    {
        $assetLocation = AssetLocation::create($request->all());

        return redirect()->route('admin.asset-locations.index');
    }

    public function edit(AssetLocation $assetLocation)
    {
        abort_if(Gate::denies('asset_location_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $networks = Network::all()->pluck('network', 'id')->prepend(trans('global.pleaseSelect'), '');

        $zones = Zone::all()->pluck('zone', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areas = Area::all()->pluck('area', 'id')->prepend(trans('global.pleaseSelect'), '');

        $provinces = Province::all()->pluck('province', 'id')->prepend(trans('global.pleaseSelect'), '');

        $municipalities = Municipality::all()->pluck('municipality', 'id')->prepend(trans('global.pleaseSelect'), '');

        $records = Record::all()->pluck('idrecord', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assetLocation->load('network', 'zone', 'area', 'province', 'municipality', 'record');

        return view('admin.assetLocations.edit', compact('networks', 'zones', 'areas', 'provinces', 'municipalities', 'record', 'assetLocation'));
    }

    public function update(UpdateAssetLocationRequest $request, AssetLocation $assetLocation)
    {
        $assetLocation->update($request->all());

        return redirect()->route('admin.asset-locations.index');
    }

    public function show(AssetLocation $assetLocation)
    {
        abort_if(Gate::denies('asset_location_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetLocation->load('network', 'zone', 'area', 'province', 'municipality', 'record');

        return view('admin.assetLocations.show', compact('assetLocation'));
    }

    public function destroy(AssetLocation $assetLocation)
    {
        abort_if(Gate::denies('asset_location_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetLocation->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssetLocationRequest $request)
    {
        AssetLocation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
