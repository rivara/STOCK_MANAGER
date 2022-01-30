<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTechniqueRequest;
use App\Http\Requests\StoreTechniqueRequest;
use App\Http\Requests\UpdateTechniqueRequest;
use App\Models\Technique;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TechniquesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('technique_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $techniques = Technique::all();

        return view('admin.techniques.index', compact('techniques'));
    }

    public function create()
    {
        abort_if(Gate::denies('technique_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.techniques.create');
    }

    public function store(StoreTechniqueRequest $request)
    {
        $technique = Technique::create($request->all());

        return redirect()->route('admin.techniques.index');
    }

    public function edit(Technique $technique)
    {
        abort_if(Gate::denies('technique_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.techniques.edit', compact('technique'));
    }

    public function update(UpdateTechniqueRequest $request, Technique $technique)
    {
        $technique->update($request->all());

        return redirect()->route('admin.techniques.index');
    }

    public function show(Technique $technique)
    {
        abort_if(Gate::denies('technique_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.techniques.show', compact('technique'));
    }

    public function destroy(Technique $technique)
    {
        abort_if(Gate::denies('technique_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $technique->delete();

        return back();
    }

    public function massDestroy(MassDestroyTechniqueRequest $request)
    {
        Technique::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
