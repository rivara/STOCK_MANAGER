<?php

namespace App\Http\Requests;

use App\Models\IncidencesSubcategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyIncidencesSubcategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('incidences_subcategory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:incidences_subcategories,id',
        ];
    }
}
