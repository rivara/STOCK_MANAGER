<?php

namespace App\Http\Requests;

use App\Models\Zone;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateZoneRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('zone_edit');
    }

    public function rules()
    {
        return [
            'network_id' => [
                'required',
                'integer',
            ],
            'zone'       => [
                'string',
                'required',
                'unique:zones,zone,' . request()->route('zone')->id,
            ],
        ];
    }
}
