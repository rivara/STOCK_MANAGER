<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreRecordRequest;
use App\Models\Record;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class RecordsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('record_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $records = Record::all();

        $users = User::get();

        return view('frontend.records.index', compact('records', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('record_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $created_bies = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.records.create', compact('created_bies'));
    }

    public function store(StoreRecordRequest $request)
    {
        $record = Record::create($request->all());

        foreach ($request->input('attached', []) as $file) {
            $record->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('attached');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $record->id]);
        }

        return redirect()->route('frontend.records.index');
    }

    public function show(Record $record)
    {
        abort_if(Gate::denies('record_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $record->load('created_by');

        return view('frontend.records.show', compact('record'));
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('record_create') && Gate::denies('record_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Record();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
