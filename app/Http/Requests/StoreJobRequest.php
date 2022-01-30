<?php

namespace App\Http\Requests;

use App\Models\Job;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreJobRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_create');
    }

    public function rules()
    {
        return [
            'idjob'       => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'description' => [
                'string',
                'required',
            ],
            'type_id'     => [
                'required',
                'integer',
            ],
            'active'      => [
                'required',
            ],
        ];
    }
}
