<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyParameterRequest;
use App\Http\Requests\StoreParameterRequest;
use App\Http\Requests\UpdateParameterRequest;
use App\Models\Asset;
use App\Models\AssetLocation;
use App\Models\Calculation;
use App\Models\Magnitude;
use App\Models\Parameter;
use App\Models\Technique;
use App\Models\Unit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParametersController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('parameter_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parameters = Parameter::all();

        $magnitudes = Magnitude::get();

        $techniques = Technique::get();

        $units = Unit::get();

        $calculations = Calculation::get();

        $asset_locations = AssetLocation::get();

        $assets = Asset::get();

        return view('frontend.parameters.index', compact('parameters', 'magnitudes', 'techniques', 'units', 'calculations', 'asset_locations', 'assets'));
    }

    public function create()
    {
        abort_if(Gate::denies('parameter_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $idmagnitudes = Magnitude::all()->pluck('magnitude', 'id')->prepend(trans('global.pleaseSelect'), '');

        $techniques = Technique::all()->pluck('technique', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units = Unit::all()->pluck('unit', 'id')->prepend(trans('global.pleaseSelect'), '');

        $calculations = Calculation::all()->pluck('calculation', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = AssetLocation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assets = Asset::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.parameters.create', compact('idmagnitudes', 'techniques', 'units', 'calculations', 'locations', 'assets'));
    }

    public function store(StoreParameterRequest $request)
    {
        $parameter = Parameter::create($request->all());

        return redirect()->route('frontend.parameters.index');
    }

    public function edit(Parameter $parameter)
    {
        abort_if(Gate::denies('parameter_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $idmagnitudes = Magnitude::all()->pluck('magnitude', 'id')->prepend(trans('global.pleaseSelect'), '');

        $techniques = Technique::all()->pluck('technique', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units = Unit::all()->pluck('unit', 'id')->prepend(trans('global.pleaseSelect'), '');

        $calculations = Calculation::all()->pluck('calculation', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = AssetLocation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assets = Asset::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $parameter->load('idmagnitude', 'technique', 'unit', 'calculation', 'location', 'asset');

        return view('frontend.parameters.edit', compact('idmagnitudes', 'techniques', 'units', 'calculations', 'locations', 'assets', 'parameter'));
    }

    public function update(UpdateParameterRequest $request, Parameter $parameter)
    {
        $parameter->update($request->all());

        return redirect()->route('frontend.parameters.index');
    }

    public function show(Parameter $parameter)
    {
        abort_if(Gate::denies('parameter_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parameter->load('idmagnitude', 'technique', 'unit', 'calculation', 'location', 'asset');

        return view('frontend.parameters.show', compact('parameter'));
    }

    public function destroy(Parameter $parameter)
    {
        abort_if(Gate::denies('parameter_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parameter->delete();

        return back();
    }

    public function massDestroy(MassDestroyParameterRequest $request)
    {
        Parameter::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
