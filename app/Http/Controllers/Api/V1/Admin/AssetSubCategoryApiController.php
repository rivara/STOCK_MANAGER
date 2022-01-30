<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssetSubCategoryRequest;
use App\Http\Requests\UpdateAssetSubCategoryRequest;
use App\Http\Resources\Admin\AssetSubCategoryResource;
use App\Models\AssetSubCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetSubCategoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('asset_sub_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssetSubCategoryResource(AssetSubCategory::with(['asset_category'])->get());
    }

    public function store(StoreAssetSubCategoryRequest $request)
    {
        $assetSubCategory = AssetSubCategory::create($request->all());

        return (new AssetSubCategoryResource($assetSubCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AssetSubCategory $assetSubCategory)
    {
        abort_if(Gate::denies('asset_sub_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssetSubCategoryResource($assetSubCategory->load(['asset_category']));
    }

    public function update(UpdateAssetSubCategoryRequest $request, AssetSubCategory $assetSubCategory)
    {
        $assetSubCategory->update($request->all());

        return (new AssetSubCategoryResource($assetSubCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AssetSubCategory $assetSubCategory)
    {
        abort_if(Gate::denies('asset_sub_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetSubCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
