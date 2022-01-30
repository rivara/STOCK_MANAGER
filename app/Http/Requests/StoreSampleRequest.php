<?php

namespace App\Http\Requests;

use App\Models\Sample;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSampleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sample_create');
    }

    public function rules()
    {
        return [
            'mark_id'     => [
                'required',
                'integer',
            ],
            'sample'      => [
                'string',
                'required',
                'unique:samples',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
