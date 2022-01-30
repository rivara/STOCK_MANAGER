<?php

namespace App\Http\Requests;

use App\Models\Network;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateNetworkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('network_edit');
    }

    public function rules()
    {
        return [
            'network'     => [
                'string',
                'required',
                'unique:networks,network,' . request()->route('network')->id,
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
