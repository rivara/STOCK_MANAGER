<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSampleRequest;
use App\Http\Requests\UpdateSampleRequest;
use App\Http\Resources\Admin\SampleResource;
use App\Models\Sample;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SamplesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sample_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SampleResource(Sample::with(['mark'])->get());
    }

    public function store(StoreSampleRequest $request)
    {
        $sample = Sample::create($request->all());

        return (new SampleResource($sample))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Sample $sample)
    {
        abort_if(Gate::denies('sample_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SampleResource($sample->load(['mark']));
    }

    public function update(UpdateSampleRequest $request, Sample $sample)
    {
        $sample->update($request->all());

        return (new SampleResource($sample))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Sample $sample)
    {
        abort_if(Gate::denies('sample_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sample->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
