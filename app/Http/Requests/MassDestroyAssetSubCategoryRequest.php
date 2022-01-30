<?php

namespace App\Http\Requests;

use App\Models\AssetSubCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAssetSubCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('asset_sub_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:asset_sub_categories,id',
        ];
    }
}
