<?php

namespace Sharmindar\Core\User\DataGrids;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Webkul\DataGrid\DataGrid;

class EmployeeDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     */
    public function prepareQueryBuilder(): Builder
    {
        $queryBuilder = DB::table('users')
            ->select(
            'users.id',
            'users.name',
            'users.email',
            'users.image',
            'users.status',
            'employee_profiles.job_title',
            'employee_profiles.joining_date',
            'employee_profiles.salary_type',
            'employee_profiles.salary_amount'
        )
            ->join('employee_profiles', 'users.id', '=', 'employee_profiles.user_id');

        return $queryBuilder;
    }

    /**
     * Add columns.
     */
    public function prepareColumns(): void
    {
        $this->addColumn([
            'index' => 'id',
            'label' => 'ID',
            'type' => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index' => 'name',
            'label' => 'Name',
            'type' => 'string',
            'sortable' => true,
            'searchable' => true,
            'filterable' => true,
            'closure' => function ($row) {
            if ($row->image) {
                return '<div class="flex items-center gap-2.5"><img class="flex h-9 w-9 items-center justify-center rounded-full object-cover" src="' . Storage::url($row->image) . '" /><span>' . $row->name . '</span></div>';
            }
            return '<div class="flex items-center gap-2.5"><div class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-color text-xs font-semibold text-white">' . substr($row->name, 0, 1) . '</div><span>' . $row->name . '</span></div>';
        },
        ]);

        $this->addColumn([
            'index' => 'job_title',
            'label' => 'Job Title',
            'type' => 'string',
            'sortable' => true,
            'searchable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index' => 'joining_date',
            'label' => 'Joining Date',
            'type' => 'date',
            'sortable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index' => 'salary_amount',
            'label' => 'Salary',
            'type' => 'string',
            'sortable' => true,
            'closure' => function ($row) {
            return $row->salary_amount . ' / ' . ucfirst($row->salary_type);
        },
        ]);

        $this->addColumn([
            'index' => 'status',
            'label' => 'Status',
            'type' => 'boolean',
            'filterable' => true,
            'sortable' => true,
            'closure' => function ($row) {
            if ($row->status == 1) {
                return '<span class="label-active">Active</span>';
            }

            return '<span class="label-inactive">Inactive</span>';
        },
        ]);
    }

    /**
     * Prepare actions.
     */
    public function prepareActions(): void
    {
        $this->addAction([
            'index' => 'edit',
            'icon' => 'icon-edit',
            'title' => 'Edit',
            'method' => 'GET',
            'url' => fn($row) => route('company.core.user.employees.edit', $row->id),
        ]);
    }
}
