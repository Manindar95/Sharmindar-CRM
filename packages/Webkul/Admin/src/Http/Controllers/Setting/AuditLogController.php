<?php

namespace Webkul\Admin\Http\Controllers\Setting;

use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\DataGrids\Setting\AuditLogDataGrid;

class AuditLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return datagrid(AuditLogDataGrid::class)->process();
        }

        return view('admin::settings.audit-logs.index');
    }
}
