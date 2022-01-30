<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMagnitudeRequest;
use App\Http\Requests\UpdateMagnitudeRequest;
use App\Http\Resources\Admin\MagnitudeResource;
use App\Models\Magnitude;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MagnitudesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('magnitude_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MagnitudeResource(Magnitude::with(['idunit'])->get());
    }

    public function store(StoreMagnitudeRequest $request)
    {
        $magnitude = Magnitude::create($request->all());

        return (new MagnitudeResource($magnitude))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Magnitude $magnitude)
    {
        abort_if(Gate::denies('magnitude_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MagnitudeResource($magnitude->load(['idunit']));
    }

    public function update(UpdateMagnitudeRequest $request, Magnitude $magnitude)
    {
        $magnitude->update($request->all());

        return (new MagnitudeResource($magnitude))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Magnitude $magnitude)
    {
        abort_if(Gate::denies('magnitude_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $magnitude->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
