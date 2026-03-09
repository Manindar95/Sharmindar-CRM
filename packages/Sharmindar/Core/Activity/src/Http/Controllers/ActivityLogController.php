<?php

namespace Sharmindar\Core\Activity\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Sharmindar\Core\Activity\DataGrids\ActivityLogDataGrid;

class ActivityLogController extends Controller
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
            return app(ActivityLogDataGrid::class)->toJson();
        }

        return view('company_activity::admin.activity-logs.index');
    }
}
