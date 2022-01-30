<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCalculationRequest;
use App\Http\Requests\UpdateCalculationRequest;
use App\Http\Resources\Admin\CalculationResource;
use App\Models\Calculation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CalculationsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('calculation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CalculationResource(Calculation::all());
    }

    public function store(StoreCalculationRequest $request)
    {
        $calculation = Calculation::create($request->all());

        return (new CalculationResource($calculation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Calculation $calculation)
    {
        abort_if(Gate::denies('calculation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CalculationResource($calculation);
    }

    public function update(UpdateCalculationRequest $request, Calculation $calculation)
    {
        $calculation->update($request->all());

        return (new CalculationResource($calculation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Calculation $calculation)
    {
        abort_if(Gate::denies('calculation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $calculation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
