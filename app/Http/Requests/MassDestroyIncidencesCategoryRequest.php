<?php

namespace App\Http\Requests;

use App\Models\IncidencesCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyIncidencesCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('incidences_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:incidences_categories,id',
        ];
    }
}
