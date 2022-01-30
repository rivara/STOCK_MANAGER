<?php

namespace App\Http\Requests;

use App\Models\AssetSubCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAssetSubCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('asset_sub_category_edit');
    }

    public function rules()
    {
        return [
            'asset_category_id' => [
                'required',
                'integer',
            ],
            'asset_subcategory' => [
                'string',
                'required',
            ],
        ];
    }
}
