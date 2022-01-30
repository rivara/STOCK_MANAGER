<?php

namespace App\Http\Requests;

use App\Models\Mark;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMarkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mark_edit');
    }

    public function rules()
    {
        return [
            'mark'        => [
                'string',
                'required',
                'unique:marks,mark,' . request()->route('mark')->id,
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
