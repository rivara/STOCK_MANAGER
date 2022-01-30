<?php

namespace App\Http\Controllers\Frontend;

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

class AssetLocationController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('asset_location_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetLocations = AssetLocation::all();

        $networks = Network::get();

        $zones = Zone::get();

        $areas = Area::get();

        $provinces = Province::get();

        $municipalities = Municipality::get();

        $records = Record::get();

        return view('frontend.assetLocations.index', compact('assetLocations', 'networks', 'zones', 'areas', 'provinces', 'municipalities', 'records'));
    }

    public function create()
    {
        abort_if(Gate::denies('asset_location_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $networks = Network::all()->pluck('network', 'id')->prepend(trans('global.pleaseSelect'), '');

        $zones = Zone::all()->pluck('zone', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areas = Area::all()->pluck('area', 'id')->prepend(trans('global.pleaseSelect'), '');

        $provinces = Province::all()->pluck('province', 'id')->prepend(trans('global.pleaseSelect'), '');

        $municipalities = Municipality::all()->pluck('municipality', 'id')->prepend(trans('global.pleaseSelect'), '');

        $records = Record::all()->pluck('idrecord', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.assetLocations.create', compact('networks', 'zones', 'areas', 'provinces', 'municipalities', 'records'));
    }

    public function store(StoreAssetLocationRequest $request)
    {
        $assetLocation = AssetLocation::create($request->all());

        return redirect()->route('frontend.asset-locations.index');
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

        return view('frontend.assetLocations.edit', compact('networks', 'zones', 'areas', 'provinces', 'municipalities', 'records', 'assetLocation'));
    }

    public function update(UpdateAssetLocationRequest $request, AssetLocation $assetLocation)
    {
        $assetLocation->update($request->all());

        return redirect()->route('frontend.asset-locations.index');
    }

    public function show(AssetLocation $assetLocation)
    {
        abort_if(Gate::denies('asset_location_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetLocation->load('network', 'zone', 'area', 'province', 'municipality', 'record');

        return view('frontend.assetLocations.show', compact('assetLocation'));
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
