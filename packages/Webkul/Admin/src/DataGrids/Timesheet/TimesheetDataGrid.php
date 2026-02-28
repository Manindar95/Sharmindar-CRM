<?php

namespace Webkul\Admin\DataGrids\Timesheet;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class TimesheetDataGrid extends DataGrid
{
    public function prepareQueryBuilder(): Builder
    {
        return DB::table('timesheets')
            ->leftJoin('projects', 'timesheets.project_id', '=', 'projects.id')
            ->leftJoin('tasks', 'timesheets.task_id', '=', 'tasks.id')
            ->leftJoin('users', 'timesheets.user_id', '=', 'users.id')
            ->select(
                'timesheets.id',
                'timesheets.date',
                'projects.name as project_name',
                'tasks.title as task_title',
                'users.name as user_name',
                'timesheets.hours',
                'timesheets.description',
            );
    }

    public function prepareColumns(): void
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.timesheets.index.datagrid.id'),
            'type'       => 'integer',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'date',
            'label'      => trans('admin::app.timesheets.index.datagrid.date'),
            'type'       => 'date',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'project_name',
            'label'      => trans('admin::app.timesheets.index.datagrid.project'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
            'closure'    => fn ($row) => $row->project_name ?? '--',
        ]);

        $this->addColumn([
            'index'      => 'task_title',
            'label'      => trans('admin::app.timesheets.index.datagrid.task'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
            'closure'    => fn ($row) => $row->task_title ?? '--',
        ]);

        $this->addColumn([
            'index'      => 'user_name',
            'label'      => trans('admin::app.timesheets.index.datagrid.user'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'hours',
            'label'      => trans('admin::app.timesheets.index.datagrid.hours'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'description',
            'label'      => trans('admin::app.timesheets.index.datagrid.description'),
            'type'       => 'string',
            'sortable'   => false,
            'closure'    => fn ($row) => $row->description ?? '--',
        ]);
    }

    public function prepareActions(): void
    {
        $this->addAction([
            'index'  => 'edit',
            'icon'   => 'icon-edit',
            'title'  => trans('admin::app.timesheets.index.datagrid.edit'),
            'method' => 'GET',
            'url'    => fn ($row) => route('admin.timesheets.edit', $row->id),
        ]);

        $this->addAction([
            'index'  => 'delete',
            'icon'   => 'icon-delete',
            'title'  => trans('admin::app.timesheets.index.datagrid.delete'),
            'method' => 'DELETE',
            'url'    => fn ($row) => route('admin.timesheets.delete', $row->id),
        ]);
    }

    public function prepareMassActions(): void
    {
        $this->addMassAction([
            'icon'   => 'icon-delete',
            'title'  => trans('admin::app.timesheets.index.datagrid.delete'),
            'method' => 'POST',
            'url'    => route('admin.timesheets.mass_delete'),
        ]);
    }
}
