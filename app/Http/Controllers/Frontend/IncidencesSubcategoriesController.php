<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIncidencesSubcategoryRequest;
use App\Http\Requests\StoreIncidencesSubcategoryRequest;
use App\Http\Requests\UpdateIncidencesSubcategoryRequest;
use App\Models\IncidencesCategory;
use App\Models\IncidencesSubcategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IncidencesSubcategoriesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('incidences_subcategory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidencesSubcategories = IncidencesSubcategory::all();

        return view('frontend.incidencesSubcategories.index', compact('incidencesSubcategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('incidences_subcategory_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidence_categories = IncidencesCategory::all()->pluck('incidence_category', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.incidencesSubcategories.create', compact('incidence_categories'));
    }

    public function store(StoreIncidencesSubcategoryRequest $request)
    {
        $incidencesSubcategory = IncidencesSubcategory::create($request->all());

        return redirect()->route('frontend.incidences-subcategories.index');
    }

    public function edit(IncidencesSubcategory $incidencesSubcategory)
    {
        abort_if(Gate::denies('incidences_subcategory_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidence_categories = IncidencesCategory::all()->pluck('incidence_category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $incidencesSubcategory->load('incidence_category');

        return view('frontend.incidencesSubcategories.edit', compact('incidence_categories', 'incidencesSubcategory'));
    }

    public function update(UpdateIncidencesSubcategoryRequest $request, IncidencesSubcategory $incidencesSubcategory)
    {
        $incidencesSubcategory->update($request->all());

        return redirect()->route('frontend.incidences-subcategories.index');
    }

    public function show(IncidencesSubcategory $incidencesSubcategory)
    {
        abort_if(Gate::denies('incidences_subcategory_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidencesSubcategory->load('incidence_category');

        return view('frontend.incidencesSubcategories.show', compact('incidencesSubcategory'));
    }

    public function destroy(IncidencesSubcategory $incidencesSubcategory)
    {
        abort_if(Gate::denies('incidences_subcategory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidencesSubcategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyIncidencesSubcategoryRequest $request)
    {
        IncidencesSubcategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
