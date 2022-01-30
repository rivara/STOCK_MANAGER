<?php

namespace App\Http\Requests;

use App\Models\Task;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTaskRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('task_edit');
    }

    public function rules()
    {
        return [
            'tags.*'          => [
                'integer',
            ],
            'tags'            => [
                'required',
                'array',
            ],
            'status_id'       => [
                'required',
                'integer',
            ],
            'location_id'     => [
                'required',
                'integer',
            ],
            'asset_id'        => [
                'required',
                'integer',
            ],
            'asset_status_id' => [
                'required',
                'integer',
            ],
            'incidence_category_id' => [
                'required',
                'integer',
            ],
            'incidence_subcategory_id' => [
                'required',
                'integer',                
            ],
            'start_date'      => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'due_date'        => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'end_date'        => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'link'            => [
                'string',
                'nullable',
            ],
        ];
    }
}
