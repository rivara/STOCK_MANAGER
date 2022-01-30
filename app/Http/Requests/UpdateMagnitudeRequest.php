<?php

namespace App\Http\Requests;

use App\Models\Magnitude;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMagnitudeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('magnitude_edit');
    }

    public function rules()
    {
        return [
            'idmagnitude' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:magnitudes,idmagnitude,' . request()->route('magnitude')->id,
            ],
            'magnitude'   => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'high'        => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'low'         => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
