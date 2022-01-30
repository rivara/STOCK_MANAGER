<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyJobRequest;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Job;
use App\Models\Mark;
use App\Models\Sample;
use App\Models\TaskTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('job_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::all();

        $task_tags = TaskTag::get();

        $marks = Mark::get();

        $samples = Sample::get();

        return view('frontend.jobs.index', compact('jobs', 'task_tags', 'marks', 'samples'));
    }

    public function create()
    {
        abort_if(Gate::denies('job_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = TaskTag::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $marks = Mark::all()->pluck('mark', 'id')->prepend(trans('global.pleaseSelect'), '');

        $samples = Sample::all()->pluck('sample', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.jobs.create', compact('types', 'marks', 'samples'));
    }

    public function store(StoreJobRequest $request)
    {
        $job = Job::create($request->all());

        return redirect()->route('frontend.jobs.index');
    }

    public function edit(Job $job)
    {
        abort_if(Gate::denies('job_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = TaskTag::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $marks = Mark::all()->pluck('mark', 'id')->prepend(trans('global.pleaseSelect'), '');

        $samples = Sample::all()->pluck('sample', 'id')->prepend(trans('global.pleaseSelect'), '');

        $job->load('type', 'mark', 'sample');

        return view('frontend.jobs.edit', compact('types', 'marks', 'samples', 'job'));
    }

    public function update(UpdateJobRequest $request, Job $job)
    {
        $job->update($request->all());

        return redirect()->route('frontend.jobs.index');
    }

    public function show(Job $job)
    {
        abort_if(Gate::denies('job_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job->load('type', 'mark', 'sample');

        return view('frontend.jobs.show', compact('job'));
    }

    public function destroy(Job $job)
    {
        abort_if(Gate::denies('job_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job->delete();

        return back();
    }

    public function massDestroy(MassDestroyJobRequest $request)
    {
        Job::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
