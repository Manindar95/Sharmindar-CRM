<?php

namespace Sharmindar\Core\Activity\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Sharmindar\Core\Activity\DataGrids\AuditTrailDataGrid;

class AuditTrailController extends Controller
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
            return app(AuditTrailDataGrid::class)->toJson();
        }

        return view('company_activity::admin.audit-trails.index');
    }
}
