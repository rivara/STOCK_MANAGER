<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class ParametersController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('parameter_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Parameter::with(['idmagnitude', 'technique', 'unit', 'calculation', 'location', 'asset'])->select(sprintf('%s.*', (new Parameter)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'parameter_show';
                $editGate      = 'parameter_edit';
                $deleteGate    = 'parameter_delete';
                $crudRoutePart = 'parameters';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('idmagnitude_magnitude', function ($row) {
                return $row->idmagnitude ? $row->idmagnitude->magnitude : '';
            });

            $table->editColumn('idmagnitude.magnitude', function ($row) {
                return $row->idmagnitude ? (is_string($row->idmagnitude) ? $row->idmagnitude : $row->idmagnitude->magnitude) : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });
            $table->addColumn('technique_technique', function ($row) {
                return $row->technique ? $row->technique->technique : '';
            });

            $table->addColumn('unit_unit', function ($row) {
                return $row->unit ? $row->unit->unit : '';
            });

            $table->addColumn('calculation_calculation', function ($row) {
                return $row->calculation ? $row->calculation->calculation : '';
            });

            $table->editColumn('active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->active ? 'checked' : null) . '>';
            });
            $table->editColumn('period', function ($row) {
                return $row->period ? $row->period : "";
            });
            $table->editColumn('decimals', function ($row) {
                return $row->decimals ? $row->decimals : "";
            });
            $table->editColumn('max_value', function ($row) {
                return $row->max_value ? $row->max_value : "";
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

            $table->editColumn('formula', function ($row) {
                return $row->formula ? $row->formula : "";
            });
            $table->editColumn('alarm', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->alarm ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'idmagnitude', 'technique', 'unit', 'calculation', 'active', 'location', 'asset', 'alarm']);

            return $table->make(true);
        }

        $magnitudes      = Magnitude::get();
        $techniques      = Technique::get();
        $units           = Unit::get();
        $calculations    = Calculation::get();
        $asset_locations = AssetLocation::get();
        $assets          = Asset::get();

        return view('admin.parameters.index', compact('magnitudes', 'techniques', 'units', 'calculations', 'asset_locations', 'assets'));
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

        return view('admin.parameters.create', compact('idmagnitudes', 'techniques', 'units', 'calculations', 'locations', 'assets'));
    }

    public function store(StoreParameterRequest $request)
    {
        $parameter = Parameter::create($request->all());

        return redirect()->route('admin.parameters.index');
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

        return view('admin.parameters.edit', compact('idmagnitudes', 'techniques', 'units', 'calculations', 'locations', 'assets', 'parameter'));
    }

    public function update(UpdateParameterRequest $request, Parameter $parameter)
    {
        $parameter->update($request->all());

        return redirect()->route('admin.parameters.index');
    }

    public function show(Parameter $parameter)
    {
        abort_if(Gate::denies('parameter_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parameter->load('idmagnitude', 'technique', 'unit', 'calculation', 'location', 'asset');

        return view('admin.parameters.show', compact('parameter'));
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
