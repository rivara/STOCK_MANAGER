<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreRecordRequest;
use App\Http\Resources\Admin\RecordResource;
use App\Models\Record;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecordsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('record_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RecordResource(Record::with(['created_by'])->get());
    }

    public function store(StoreRecordRequest $request)
    {
        $record = Record::create($request->all());

        if ($request->input('attached', false)) {
            $record->addMedia(storage_path('tmp/uploads/' . $request->input('attached')))->toMediaCollection('attached');
        }

        return (new RecordResource($record))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Record $record)
    {
        abort_if(Gate::denies('record_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RecordResource($record->load(['created_by']));
    }
}
