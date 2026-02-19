<?php

namespace Webkul\Admin\DataGrids\Task;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class TaskDataGrid extends DataGrid
{
    public function prepareQueryBuilder(): Builder
    {
        return DB::table('tasks')
            ->leftJoin('projects', 'tasks.project_id', '=', 'projects.id')
            ->leftJoin('users', 'tasks.assigned_to', '=', 'users.id')
            ->select(
                'tasks.id',
                'tasks.title',
                'projects.name as project_name',
                'tasks.status',
                'tasks.priority',
                'tasks.due_date',
                'users.name as assigned_to_name',
            );
    }

    public function prepareColumns(): void
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.tasks.index.datagrid.id'),
            'type'       => 'integer',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'title',
            'label'      => trans('admin::app.tasks.index.datagrid.title'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'project_name',
            'label'      => trans('admin::app.tasks.index.datagrid.project'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
            'closure'    => fn ($row) => $row->project_name ?? '--',
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => trans('admin::app.tasks.index.datagrid.status'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                $labels = [
                    'pending'     => 'Pending',
                    'in_progress' => 'In Progress',
                    'completed'   => 'Completed',
                ];

                return $labels[$row->status] ?? $row->status;
            },
        ]);

        $this->addColumn([
            'index'      => 'priority',
            'label'      => trans('admin::app.tasks.index.datagrid.priority'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
            'closure'    => fn ($row) => ucfirst($row->priority),
        ]);

        $this->addColumn([
            'index'      => 'due_date',
            'label'      => trans('admin::app.tasks.index.datagrid.due-date'),
            'type'       => 'date',
            'sortable'   => true,
            'filterable' => true,
            'closure'    => fn ($row) => $row->due_date ?? '--',
        ]);

        $this->addColumn([
            'index'      => 'assigned_to_name',
            'label'      => trans('admin::app.tasks.index.datagrid.assigned-to'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
            'closure'    => fn ($row) => $row->assigned_to_name ?? '--',
        ]);
    }

    public function prepareActions(): void
    {
        $this->addAction([
            'index'  => 'edit',
            'icon'   => 'icon-edit',
            'title'  => trans('admin::app.tasks.index.datagrid.edit'),
            'method' => 'GET',
            'url'    => fn ($row) => route('admin.tasks.edit', $row->id),
        ]);

        $this->addAction([
            'index'  => 'delete',
            'icon'   => 'icon-delete',
            'title'  => trans('admin::app.tasks.index.datagrid.delete'),
            'method' => 'DELETE',
            'url'    => fn ($row) => route('admin.tasks.delete', $row->id),
        ]);
    }

    public function prepareMassActions(): void
    {
        $this->addMassAction([
            'icon'   => 'icon-delete',
            'title'  => trans('admin::app.tasks.index.datagrid.delete'),
            'method' => 'POST',
            'url'    => route('admin.tasks.mass_delete'),
        ]);
    }
}
