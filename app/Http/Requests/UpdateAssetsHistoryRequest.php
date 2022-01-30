<?php

namespace App\Http\Requests;

use App\Models\AssetsHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAssetsHistoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('assets_history_edit');
    }

    public function rules()
    {
        return [
            'start_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'end_date'   => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
