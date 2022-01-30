<?php

namespace App\Http\Requests;

use App\Models\IncidencesCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreIncidencesCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('incidences_category_create');
    }

    public function rules()
    {
        return [
            'incidence_category' => [
                'string',
                'required',
                'unique:incidences_categories',
            ],
        ];
    }
}
