<?php

namespace Company\Core\Activity\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class AuditTrailDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('audit_trails')
            ->leftJoin('users', 'audit_trails.user_id', '=', 'users.id')
            ->addSelect(
            'audit_trails.id',
            'users.name as user_name',
            'audit_trails.auditable_type',
            'audit_trails.auditable_id',
            'audit_trails.event',
            'audit_trails.created_at'
        );

        $this->addFilter('id', 'audit_trails.id');
        $this->addFilter('user_name', 'users.name');

        $this->setQueryBuilder($queryBuilder);
    }

    /**
     * Add columns.
     *
     * @return void
     */
    public function addColumns()
    {
        $this->addColumn([
            'index' => 'id',
            'label' => trans('admin::app.datagrid.id'),
            'type' => 'string',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index' => 'user_name',
            'label' => 'User Name',
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index' => 'auditable_type',
            'label' => 'Model Type',
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
            'closure' => function ($row) {
            // Return just the classname without namespace for cleaner UI
            return class_basename($row->auditable_type);
        }
        ]);

        $this->addColumn([
            'index' => 'auditable_id',
            'label' => 'Record ID',
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index' => 'event',
            'label' => 'Event',
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
            'closure' => function ($row) {
            $badges = [
                    'created' => 'badge-success',
                    'updated' => 'badge-warning',
                    'deleted' => 'badge-danger',
                ];

            $badgeClass = $badges[$row->event] ?? 'badge-primary';
            return '<span class="badge ' . $badgeClass . '">' . ucfirst($row->event) . '</span>';
        }
        ]);

        $this->addColumn([
            'index' => 'created_at',
            'label' => trans('admin::app.datagrid.created_at'),
            'type' => 'datetime',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true,
        ]);
    }
}
