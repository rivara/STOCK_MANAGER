<?php

namespace App\Http\Requests;

use App\Models\Job;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateJobRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_edit');
    }

    public function rules()
    {
        return [
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
