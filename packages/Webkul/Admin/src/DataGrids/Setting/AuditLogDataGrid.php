<?php

namespace Webkul\Admin\DataGrids\Setting;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;
use Webkul\User\Repositories\UserRepository;

class AuditLogDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     */
    public function prepareQueryBuilder(): Builder
    {
        $queryBuilder = DB::table('audit_logs')
            ->addSelect(
                'audit_logs.id',
                'audit_logs.user_name',
                'audit_logs.action',
                'audit_logs.method',
                'audit_logs.url',
                'audit_logs.ip_address',
                'audit_logs.created_at'
            );

        $this->addFilter('id', 'audit_logs.id');
        $this->addFilter('user_name', 'audit_logs.user_name');
        $this->addFilter('action', 'audit_logs.action');
        $this->addFilter('method', 'audit_logs.method');
        $this->addFilter('ip_address', 'audit_logs.ip_address');
        $this->addFilter('created_at', 'audit_logs.created_at');

        return $queryBuilder;
    }

    /**
     * Prepare columns.
     */
    public function prepareColumns(): void
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.settings.audit-logs.index.datagrid.id'),
            'type'       => 'integer',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'user_name',
            'label'      => trans('admin::app.settings.audit-logs.index.datagrid.user'),
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'action',
            'label'      => trans('admin::app.settings.audit-logs.index.datagrid.action'),
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'method',
            'label'      => trans('admin::app.settings.audit-logs.index.datagrid.method'),
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'ip_address',
            'label'      => trans('admin::app.settings.audit-logs.index.datagrid.ip-address'),
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'created_at',
            'label'      => trans('admin::app.settings.audit-logs.index.datagrid.timestamp'),
            'type'       => 'date',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
            'closure'    => fn ($row) => core()->formatDate($row->created_at, 'd M Y H:i:s'),
        ]);
    }
}
