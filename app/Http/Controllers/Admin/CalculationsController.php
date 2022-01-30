<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCalculationRequest;
use App\Http\Requests\StoreCalculationRequest;
use App\Http\Requests\UpdateCalculationRequest;
use App\Models\Calculation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CalculationsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('calculation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $calculations = Calculation::all();

        return view('admin.calculations.index', compact('calculations'));
    }

    public function create()
    {
        abort_if(Gate::denies('calculation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.calculations.create');
    }

    public function store(StoreCalculationRequest $request)
    {
        $calculation = Calculation::create($request->all());

        return redirect()->route('admin.calculations.index');
    }

    public function edit(Calculation $calculation)
    {
        abort_if(Gate::denies('calculation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.calculations.edit', compact('calculation'));
    }

    public function update(UpdateCalculationRequest $request, Calculation $calculation)
    {
        $calculation->update($request->all());

        return redirect()->route('admin.calculations.index');
    }

    public function show(Calculation $calculation)
    {
        abort_if(Gate::denies('calculation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.calculations.show', compact('calculation'));
    }

    public function destroy(Calculation $calculation)
    {
        abort_if(Gate::denies('calculation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $calculation->delete();

        return back();
    }

    public function massDestroy(MassDestroyCalculationRequest $request)
    {
        Calculation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
