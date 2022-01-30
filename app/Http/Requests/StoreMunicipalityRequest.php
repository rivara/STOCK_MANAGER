<?php

namespace App\Http\Requests;

use App\Models\Municipality;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMunicipalityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('municipality_create');
    }

    public function rules()
    {
        return [
            'province_id'  => [
                'required',
                'integer',
            ],
            'municipality' => [
                'string',
                'required',
                'unique:municipalities',
            ],
        ];
    }
}
