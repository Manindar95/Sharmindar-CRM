<?php

namespace Sharmindar\Core\Activity\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Sharmindar\Core\Activity\DataGrids\LoginHistoryDataGrid;

class LoginHistoryController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(LoginHistoryDataGrid::class)->toJson();
        }

        return view('company_activity::admin.login-history.index');
    }
}
