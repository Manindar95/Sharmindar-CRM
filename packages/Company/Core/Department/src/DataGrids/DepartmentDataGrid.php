<?php

namespace Company\Core\Department\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class DepartmentDataGrid extends DataGrid
{
    protected $index = 'id';
    protected $sortOrder = 'desc';

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('departments')
            ->leftJoin('users', 'departments.manager_id', '=', 'users.id')
            ->leftJoin('departments as parent_dept', 'departments.parent_id', '=', 'parent_dept.id')
            ->select('departments.id', 'departments.name', 'departments.code', 'users.name as manager_name', 'parent_dept.name as parent_name');

        $this->addFilter('id', 'departments.id');
        $this->addFilter('name', 'departments.name');
        $this->addFilter('code', 'departments.code');
        $this->addFilter('manager_name', 'users.name');
        $this->addFilter('parent_name', 'parent_dept.name');

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
            'index' => 'manager_name',
            'label' => 'Manager',
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index' => 'parent_name',
            'label' => 'Parent Department',
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
            'url' => fn($row) => route('company.core.department.edit', $row->id),
        ]);

        $this->addAction([
            'index' => 'delete',
            'icon' => 'icon-trash',
            'title' => trans('admin::app.datagrid.delete'),
            'method' => 'DELETE',
            'url' => fn($row) => route('company.core.department.destroy', $row->id),
        ]);
    }
}
