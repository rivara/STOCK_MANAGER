<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIncidencesSubcategoryRequest;
use App\Http\Requests\UpdateIncidencesSubcategoryRequest;
use App\Http\Resources\Admin\IncidencesSubcategoryResource;
use App\Models\IncidencesSubcategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IncidencesSubcategoriesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('incidences_subcategory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IncidencesSubcategoryResource(IncidencesSubcategory::with(['incidence_category'])->get());
    }

    public function store(StoreIncidencesSubcategoryRequest $request)
    {
        $incidencesSubcategory = IncidencesSubcategory::create($request->all());

        return (new IncidencesSubcategoryResource($incidencesSubcategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(IncidencesSubcategory $incidencesSubcategory)
    {
        abort_if(Gate::denies('incidences_subcategory_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IncidencesSubcategoryResource($incidencesSubcategory->load(['incidence_category']));
    }

    public function update(UpdateIncidencesSubcategoryRequest $request, IncidencesSubcategory $incidencesSubcategory)
    {
        $incidencesSubcategory->update($request->all());

        return (new IncidencesSubcategoryResource($incidencesSubcategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(IncidencesSubcategory $incidencesSubcategory)
    {
        abort_if(Gate::denies('incidences_subcategory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidencesSubcategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
