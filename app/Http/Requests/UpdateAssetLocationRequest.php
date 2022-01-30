<?php

namespace App\Http\Requests;

use App\Models\AssetLocation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAssetLocationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('asset_location_edit');
    }

    public function rules()
    {
        return [
            'name'        => [
                'string',
                'required',
            ],
            'code'        => [
                'string',
                'required',
                'unique:asset_locations,code,' . request()->route('asset_location')->id,
            ],
            'name_cee'    => [
                'string',
                'required',
            ],
            'network_id'  => [
                'required',
                'integer',
            ],
            'address'     => [
                'string',
                'nullable',
            ],
            'longitude'   => [
                'numeric',
            ],
            'latitude'    => [
                'numeric',
            ],
            'altitude'    => [
                'numeric',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'start_date'  => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'end_date'    => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
