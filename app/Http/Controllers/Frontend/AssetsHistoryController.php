<?php

namespace App\Http\Controllers\Frontend;

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

class AssetsHistoryController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('assets_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetsHistories = AssetsHistory::all();

        $assets = Asset::get();

        $asset_statuses = AssetStatus::get();

        $asset_locations = AssetLocation::get();

        $users = User::get();

        return view('frontend.assetsHistories.index', compact('assetsHistories', 'assets', 'asset_statuses', 'asset_locations', 'users'));
    }

    public function show(AssetsHistory $assetsHistory)
    {
        abort_if(Gate::denies('assets_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetsHistory->load('asset', 'status', 'location', 'assigned_user');

        return view('frontend.assetsHistories.show', compact('assetsHistory'));
    }
}
