<?php

namespace App\Http\Requests;

use App\Models\Mark;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMarkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mark_create');
    }

    public function rules()
    {
        return [
            'mark'        => [
                'string',
                'required',
                'unique:marks',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
