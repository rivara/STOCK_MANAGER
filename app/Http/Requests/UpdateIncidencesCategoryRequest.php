<?php

namespace App\Http\Requests;

use App\Models\IncidencesCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateIncidencesCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('incidences_category_edit');
    }

    public function rules()
    {
        return [
            'incidence_category' => [
                'string',
                'required',
                'unique:incidences_categories,incidence_category,' . request()->route('incidences_category')->id,
            ],
        ];
    }
}
