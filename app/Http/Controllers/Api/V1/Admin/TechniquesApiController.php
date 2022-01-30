<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechniqueRequest;
use App\Http\Requests\UpdateTechniqueRequest;
use App\Http\Resources\Admin\TechniqueResource;
use App\Models\Technique;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TechniquesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('technique_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TechniqueResource(Technique::all());
    }

    public function store(StoreTechniqueRequest $request)
    {
        $technique = Technique::create($request->all());

        return (new TechniqueResource($technique))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Technique $technique)
    {
        abort_if(Gate::denies('technique_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TechniqueResource($technique);
    }

    public function update(UpdateTechniqueRequest $request, Technique $technique)
    {
        $technique->update($request->all());

        return (new TechniqueResource($technique))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Technique $technique)
    {
        abort_if(Gate::denies('technique_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $technique->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
