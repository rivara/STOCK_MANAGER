<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNetworkRequest;
use App\Http\Requests\StoreNetworkRequest;
use App\Http\Requests\UpdateNetworkRequest;
use App\Models\Network;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NetworksController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('network_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $networks = Network::all();

        return view('frontend.networks.index', compact('networks'));
    }

    public function create()
    {
        abort_if(Gate::denies('network_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.networks.create');
    }

    public function store(StoreNetworkRequest $request)
    {
        $network = Network::create($request->all());

        return redirect()->route('frontend.networks.index');
    }

    public function edit(Network $network)
    {
        abort_if(Gate::denies('network_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.networks.edit', compact('network'));
    }

    public function update(UpdateNetworkRequest $request, Network $network)
    {
        $network->update($request->all());

        return redirect()->route('frontend.networks.index');
    }

    public function show(Network $network)
    {
        abort_if(Gate::denies('network_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.networks.show', compact('network'));
    }

    public function destroy(Network $network)
    {
        abort_if(Gate::denies('network_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $network->delete();

        return back();
    }

    public function massDestroy(MassDestroyNetworkRequest $request)
    {
        Network::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
