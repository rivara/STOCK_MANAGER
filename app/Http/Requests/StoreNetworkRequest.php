<?php

namespace App\Http\Requests;

use App\Models\Network;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNetworkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('network_create');
    }

    public function rules()
    {
        return [
            'network'     => [
                'string',
                'required',
                'unique:networks',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
