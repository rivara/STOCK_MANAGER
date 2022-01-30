<?php

namespace App\Http\Requests;

use App\Models\Calculation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCalculationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('calculation_edit');
    }

    public function rules()
    {
        return [
            'calculation' => [
                'string',
                'required',
                'unique:calculations,calculation,' . request()->route('calculation')->id,
            ],
        ];
    }
}
