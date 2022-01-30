<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIncidencesCategoryRequest;
use App\Http\Requests\StoreIncidencesCategoryRequest;
use App\Http\Requests\UpdateIncidencesCategoryRequest;
use App\Models\IncidencesCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IncidencesCategoriesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('incidences_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidencesCategories = IncidencesCategory::all();

        return view('frontend.incidencesCategories.index', compact('incidencesCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('incidences_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.incidencesCategories.create');
    }

    public function store(StoreIncidencesCategoryRequest $request)
    {
        $incidencesCategory = IncidencesCategory::create($request->all());

        return redirect()->route('frontend.incidences-categories.index');
    }

    public function edit(IncidencesCategory $incidencesCategory)
    {
        abort_if(Gate::denies('incidences_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.incidencesCategories.edit', compact('incidencesCategory'));
    }

    public function update(UpdateIncidencesCategoryRequest $request, IncidencesCategory $incidencesCategory)
    {
        $incidencesCategory->update($request->all());

        return redirect()->route('frontend.incidences-categories.index');
    }

    public function show(IncidencesCategory $incidencesCategory)
    {
        abort_if(Gate::denies('incidences_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.incidencesCategories.show', compact('incidencesCategory'));
    }

    public function destroy(IncidencesCategory $incidencesCategory)
    {
        abort_if(Gate::denies('incidences_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidencesCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyIncidencesCategoryRequest $request)
    {
        IncidencesCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
