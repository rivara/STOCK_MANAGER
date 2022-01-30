<?php

namespace App\Http\Requests;

use App\Models\IncidencesSubcategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateIncidencesSubcategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('incidences_subcategory_edit');
    }

    public function rules()
    {
        return [
            'incidence_category_id' => [
                'required',
                'integer',
            ],
            'incidence_subcategory' => [
                'string',
                'required',
            ],
        ];
    }
}
