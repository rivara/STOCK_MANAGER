<?php

namespace App\Http\Requests;

use App\Models\Municipality;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMunicipalityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('municipality_edit');
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
                'unique:municipalities,municipality,' . request()->route('municipality')->id,
            ],
        ];
    }
}
