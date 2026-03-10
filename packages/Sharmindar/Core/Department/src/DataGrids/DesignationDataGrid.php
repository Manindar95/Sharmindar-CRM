<?php

namespace Sharmindar\Core\Department\DataGrids;

use Illuminate\Support\Facades\DB;
use Sharmindar\Core\DataGrid\DataGrid;

class DesignationDataGrid extends DataGrid
{
    protected $index = 'id';
    protected $sortOrder = 'desc';

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('designations')
            ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
            ->select('designations.id', 'designations.name', 'designations.code', 'departments.name as department_name');

        $this->addFilter('id', 'designations.id');
        $this->addFilter('name', 'designations.name');
        $this->addFilter('code', 'designations.code');
        $this->addFilter('department_name', 'departments.name');

        return $queryBuilder;
    }

    public function prepareColumns()
    {
        $this->addColumn([
            'index' => 'id',
            'label' => 'ID',
            'type' => 'string',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index' => 'name',
            'label' => 'Name',
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index' => 'code',
            'label' => 'Code',
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index' => 'department_name',
            'label' => 'Department',
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
        ]);
    }

    public function prepareActions()
    {
        $this->addAction([
            'index' => 'edit',
            'icon' => 'icon-edit',
            'title' => trans('admin::app.datagrid.edit'),
            'method' => 'GET',
            'url' => fn($row) => route('company.core.department.designations.edit', $row->id),
        ]);

        $this->addAction([
            'index' => 'delete',
            'icon' => 'icon-trash',
            'title' => trans('admin::app.datagrid.delete'),
            'method' => 'DELETE',
            'url' => fn($row) => route('company.core.department.designations.destroy', $row->id),
        ]);
    }
}
