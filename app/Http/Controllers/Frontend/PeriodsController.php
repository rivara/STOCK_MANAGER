<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPeriodRequest;
use App\Http\Requests\StorePeriodRequest;
use App\Http\Requests\UpdatePeriodRequest;
use App\Models\Period;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PeriodsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('period_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $periods = Period::all();

        return view('frontend.periods.index', compact('periods'));
    }

    public function create()
    {
        abort_if(Gate::denies('period_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.periods.create');
    }

    public function store(StorePeriodRequest $request)
    {
        $period = Period::create($request->all());

        return redirect()->route('frontend.periods.index');
    }

    public function edit(Period $period)
    {
        abort_if(Gate::denies('period_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.periods.edit', compact('period'));
    }

    public function update(UpdatePeriodRequest $request, Period $period)
    {
        $period->update($request->all());

        return redirect()->route('frontend.periods.index');
    }

    public function show(Period $period)
    {
        abort_if(Gate::denies('period_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.periods.show', compact('period'));
    }

    public function destroy(Period $period)
    {
        abort_if(Gate::denies('period_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $period->delete();

        return back();
    }

    public function massDestroy(MassDestroyPeriodRequest $request)
    {
        Period::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
