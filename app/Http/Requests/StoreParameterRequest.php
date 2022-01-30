<?php

namespace App\Http\Requests;

use App\Models\Parameter;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreParameterRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('parameter_create');
    }

    public function rules()
    {
        return [
            'idmagnitude_id' => [
                'required',
                'integer',
            ],
            'description'    => [
                'string',
                'min:0',
                'max:50',
                'required',
            ],
            'technique_id'   => [
                'required',
                'integer',
            ],
            'calculation_id' => [
                'required',
                'integer',
            ],
            'period'         => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'decimals'       => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'max_value'      => [
                'numeric',
            ],
            'min_value'      => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'location_id'    => [
                'required',
                'integer',
            ],
            'start_date'     => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'end_date'       => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'formula'        => [
                'string',
                'nullable',
            ],
            'alarm'          => [
                'required',
            ],
        ];
    }
}
