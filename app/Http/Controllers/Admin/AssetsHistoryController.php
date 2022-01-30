<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Models\Asset;
use App\Models\AssetLocation;
use App\Models\AssetsHistory;
use App\Models\AssetStatus;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AssetsHistoryController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('assets_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AssetsHistory::with(['asset', 'status', 'location', 'assigned_user'])->select(sprintf('%s.*', (new AssetsHistory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'assets_history_show';
                $editGate      = 'assets_history_edit';
                $deleteGate    = 'assets_history_delete';
                $crudRoutePart = 'assets-histories';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('asset_name', function ($row) {
                return $row->asset ? $row->asset->name : '';
            });

            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->addColumn('location_name', function ($row) {
                return $row->location ? $row->location->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'asset', 'status', 'location']);

            return $table->make(true);
        }

        $assets          = Asset::get();
        $asset_statuses  = AssetStatus::get();
        $asset_locations = AssetLocation::get();
        $users           = User::get();

        return view('admin.assetsHistories.index', compact('assets', 'asset_statuses', 'asset_locations', 'users'));
    }

    public function show(AssetsHistory $assetsHistory)
    {
        abort_if(Gate::denies('assets_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetsHistory->load('asset', 'status', 'location', 'assigned_user');

        return view('admin.assetsHistories.show', compact('assetsHistory'));
    }
}
