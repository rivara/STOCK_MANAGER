<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMagnitudeRequest;
use App\Http\Requests\StoreMagnitudeRequest;
use App\Http\Requests\UpdateMagnitudeRequest;
use App\Models\Magnitude;
use App\Models\Unit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MagnitudesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('magnitude_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $magnitudes = Magnitude::all();

        return view('frontend.magnitudes.index', compact('magnitudes'));
    }

    public function create()
    {
        abort_if(Gate::denies('magnitude_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $idunits = Unit::all()->pluck('unit', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.magnitudes.create', compact('idunits'));
    }

    public function store(StoreMagnitudeRequest $request)
    {
        $magnitude = Magnitude::create($request->all());

        return redirect()->route('frontend.magnitudes.index');
    }

    public function edit(Magnitude $magnitude)
    {
        abort_if(Gate::denies('magnitude_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $idunits = Unit::all()->pluck('unit', 'id')->prepend(trans('global.pleaseSelect'), '');

        $magnitude->load('idunit');

        return view('frontend.magnitudes.edit', compact('idunits', 'magnitude'));
    }

    public function update(UpdateMagnitudeRequest $request, Magnitude $magnitude)
    {
        $magnitude->update($request->all());

        return redirect()->route('frontend.magnitudes.index');
    }

    public function show(Magnitude $magnitude)
    {
        abort_if(Gate::denies('magnitude_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $magnitude->load('idunit');

        return view('frontend.magnitudes.show', compact('magnitude'));
    }

    public function destroy(Magnitude $magnitude)
    {
        abort_if(Gate::denies('magnitude_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $magnitude->delete();

        return back();
    }

    public function massDestroy(MassDestroyMagnitudeRequest $request)
    {
        Magnitude::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
