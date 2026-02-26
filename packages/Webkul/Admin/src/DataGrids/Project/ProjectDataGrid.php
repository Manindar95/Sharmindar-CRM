<?php

namespace Webkul\Admin\DataGrids\Project;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class ProjectDataGrid extends DataGrid
{
    public function prepareQueryBuilder(): Builder
    {
        return DB::table('projects')
            ->leftJoin('persons', 'projects.client_id', '=', 'persons.id')
            ->leftJoin('users as managers', 'projects.manager_id', '=', 'managers.id')
            ->select(
                'projects.id',
                'projects.name',
                'persons.name as client_name',
                'projects.status',
                'projects.start_date',
                'projects.end_date',
                'projects.expected_end_date',
                'managers.name as manager_name',
                'projects.created_at',
            );
    }

    public function prepareColumns(): void
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.projects.index.datagrid.id'),
            'type'       => 'integer',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'name',
            'label'      => trans('admin::app.projects.index.datagrid.name'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'client_name',
            'label'      => trans('admin::app.projects.create.client'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => trans('admin::app.projects.index.datagrid.status'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                $labels = [
                    'not_started' => 'Not Started',
                    'in_progress' => 'In Progress',
                    'on_hold'     => 'On Hold',
                    'completed'   => 'Completed',
                ];

                return $labels[$row->status] ?? $row->status;
            },
        ]);

        $this->addColumn([
            'index'      => 'start_date',
            'label'      => trans('admin::app.projects.index.datagrid.start-date'),
            'type'       => 'date',
            'sortable'   => true,
            'filterable' => true,
            'closure'    => fn ($row) => $row->start_date ?? '--',
        ]);

        $this->addColumn([
            'index'      => 'expected_end_date',
            'label'      => trans('admin::app.projects.create.expected-end-date'),
            'type'       => 'date',
            'sortable'   => true,
            'filterable' => true,
            'closure'    => fn ($row) => $row->expected_end_date ?? '--',
        ]);

        $this->addColumn([
            'index'      => 'manager_name',
            'label'      => trans('admin::app.projects.create.manager'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
        ]);
    }

    public function prepareActions(): void
    {
        $this->addAction([
            'index'  => 'edit',
            'icon'   => 'icon-edit',
            'title'  => trans('admin::app.projects.index.datagrid.edit'),
            'method' => 'GET',
            'url'    => fn ($row) => route('admin.projects.edit', $row->id),
        ]);

        $this->addAction([
            'index'  => 'delete',
            'icon'   => 'icon-delete',
            'title'  => trans('admin::app.projects.index.datagrid.delete'),
            'method' => 'DELETE',
            'url'    => fn ($row) => route('admin.projects.delete', $row->id),
        ]);
    }

    public function prepareMassActions(): void
    {
        $this->addMassAction([
            'icon'   => 'icon-delete',
            'title'  => trans('admin::app.projects.index.datagrid.delete'),
            'method' => 'POST',
            'url'    => route('admin.projects.mass_delete'),
        ]);
    }
}
