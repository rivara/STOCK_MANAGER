<?php

namespace App\Http\Requests;

use App\Models\Record;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRecordRequest extends FormRequest
{
   /* rvr ver autorizacion
    public function authorize()
    {
        return Gate::allows('record_edit');
    }*/
    public function rules()
    {
        return [
            'description' => [
                'string',
                'required',
            ],
            'type'        => [
                'required',
            ],
            'url'         => [
                'string',
                'max:600',
                'nullable',
            ],
        ];
    }
}
