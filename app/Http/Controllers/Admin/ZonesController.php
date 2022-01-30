<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyZoneRequest;
use App\Http\Requests\StoreZoneRequest;
use App\Http\Requests\UpdateZoneRequest;
use App\Models\Network;
use App\Models\Zone;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ZonesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('zone_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zones = Zone::all();

        return view('admin.zones.index', compact('zones'));
    }

    public function create()
    {
        abort_if(Gate::denies('zone_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $networks = Network::all()->pluck('network', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.zones.create', compact('networks'));
    }

    public function store(StoreZoneRequest $request)
    {
        $zone = Zone::create($request->all());

        return redirect()->route('admin.zones.index');
    }

    public function edit(Zone $zone)
    {
        abort_if(Gate::denies('zone_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $networks = Network::all()->pluck('network', 'id')->prepend(trans('global.pleaseSelect'), '');

        $zone->load('network');

        return view('admin.zones.edit', compact('networks', 'zone'));
    }

    public function update(UpdateZoneRequest $request, Zone $zone)
    {
        $zone->update($request->all());

        return redirect()->route('admin.zones.index');
    }

    public function show(Zone $zone)
    {
        abort_if(Gate::denies('zone_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zone->load('network');

        return view('admin.zones.show', compact('zone'));
    }

    public function destroy(Zone $zone)
    {
        abort_if(Gate::denies('zone_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zone->delete();

        return back();
    }

    public function massDestroy(MassDestroyZoneRequest $request)
    {
        Zone::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
