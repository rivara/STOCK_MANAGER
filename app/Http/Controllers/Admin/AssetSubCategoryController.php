<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAssetSubCategoryRequest;
use App\Http\Requests\StoreAssetSubCategoryRequest;
use App\Http\Requests\UpdateAssetSubCategoryRequest;
use App\Models\AssetCategory;
use App\Models\AssetSubCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetSubCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('asset_sub_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetSubCategories = AssetSubCategory::all();

        return view('admin.assetSubCategories.index', compact('assetSubCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('asset_sub_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asset_categories = AssetCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.assetSubCategories.create', compact('asset_categories'));
    }

    public function store(StoreAssetSubCategoryRequest $request)
    {
        $assetSubCategory = AssetSubCategory::create($request->all());

        return redirect()->route('admin.asset-sub-categories.index');
    }

    public function edit(AssetSubCategory $assetSubCategory)
    {
        abort_if(Gate::denies('asset_sub_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asset_categories = AssetCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assetSubCategory->load('asset_category');

        return view('admin.assetSubCategories.edit', compact('asset_categories', 'assetSubCategory'));
    }

    public function update(UpdateAssetSubCategoryRequest $request, AssetSubCategory $assetSubCategory)
    {
        $assetSubCategory->update($request->all());

        return redirect()->route('admin.asset-sub-categories.index');
    }

    public function show(AssetSubCategory $assetSubCategory)
    {
        abort_if(Gate::denies('asset_sub_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetSubCategory->load('asset_category');

        return view('admin.assetSubCategories.show', compact('assetSubCategory'));
    }

    public function destroy(AssetSubCategory $assetSubCategory)
    {
        abort_if(Gate::denies('asset_sub_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetSubCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssetSubCategoryRequest $request)
    {
        AssetSubCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
