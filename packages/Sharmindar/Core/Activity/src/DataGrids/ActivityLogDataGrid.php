<?php

namespace Sharmindar\Core\Activity\DataGrids;

use Illuminate\Support\Facades\DB;
use Sharmindar\Core\DataGrid\DataGrid;

class ActivityLogDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('activity_logs')
            ->leftJoin('users', 'activity_logs.user_id', '=', 'users.id')
            ->addSelect(
            'activity_logs.id',
            'users.name as user_name',
            'activity_logs.action',
            'activity_logs.description',
            'activity_logs.ip_address',
            'activity_logs.created_at'
        );

        $this->addFilter('id', 'activity_logs.id');
        $this->addFilter('user_name', 'users.name');

        $this->setQueryBuilder($queryBuilder);
    }

    /**
     * Prepare columns.
     *
     * @return void
     */
    public function prepareColumns()
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
            'index' => 'action',
            'label' => 'Action',
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index' => 'description',
            'label' => 'Description',
            'type' => 'string',
            'searchable' => true,
            'sortable' => false,
            'filterable' => true,
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
