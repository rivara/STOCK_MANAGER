<?php

namespace App\Http\Requests;

use App\Models\Unit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUnitRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('unit_edit');
    }

    public function rules()
    {
        return [
            'unit'        => [
                'string',
                'required',
                'unique:units,unit,' . request()->route('unit')->id,
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
