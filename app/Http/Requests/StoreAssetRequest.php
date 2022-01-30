<?php

namespace App\Http\Requests;

use App\Models\Asset;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAssetRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('asset_create');
    }

    public function rules()
    {
        return [
            'name'          => [
                'string',
                'required',
            ],
            'category_id'   => [
                'required',
                'integer',
            ],
            'serial_number' => [
                'string',
                'nullable',
            ],
            'start_date'    => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'end_date'      => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'status_id'     => [
                'required',
                'integer',
            ],
            'location_id'   => [
                'required',
                'integer',
            ],
            'regulations'   => [
                'string',
                'nullable',
            ],
        ];
    }
}
