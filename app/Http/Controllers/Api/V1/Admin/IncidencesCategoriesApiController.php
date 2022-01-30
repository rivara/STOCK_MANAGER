<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIncidencesCategoryRequest;
use App\Http\Requests\UpdateIncidencesCategoryRequest;
use App\Http\Resources\Admin\IncidencesCategoryResource;
use App\Models\IncidencesCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IncidencesCategoriesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('incidences_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IncidencesCategoryResource(IncidencesCategory::all());
    }

    public function store(StoreIncidencesCategoryRequest $request)
    {
        $incidencesCategory = IncidencesCategory::create($request->all());

        return (new IncidencesCategoryResource($incidencesCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(IncidencesCategory $incidencesCategory)
    {
        abort_if(Gate::denies('incidences_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IncidencesCategoryResource($incidencesCategory);
    }

    public function update(UpdateIncidencesCategoryRequest $request, IncidencesCategory $incidencesCategory)
    {
        $incidencesCategory->update($request->all());

        return (new IncidencesCategoryResource($incidencesCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(IncidencesCategory $incidencesCategory)
    {
        abort_if(Gate::denies('incidences_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidencesCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
