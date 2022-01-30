<?php

namespace App\Http\Requests;

use App\Models\Technique;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTechniqueRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('technique_create');
    }

    public function rules()
    {
        return [
            'idtechnique' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:techniques,idtechnique',
            ],
            'technique'   => [
                'string',
                'required',
            ],
        ];
    }
}
