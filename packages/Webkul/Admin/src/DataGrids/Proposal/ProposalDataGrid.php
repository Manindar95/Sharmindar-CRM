<?php

namespace Webkul\Admin\DataGrids\Proposal;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class ProposalDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function prepareQueryBuilder(): Builder
    {
        return DB::table('proposals')
            ->leftJoin('projects', 'proposals.project_id', '=', 'projects.id')
            ->leftJoin('persons', 'proposals.person_id', '=', 'persons.id')
            ->leftJoin('users', 'proposals.user_id', '=', 'users.id')
            ->select(
                'proposals.id',
                'proposals.proposal_id',
                'projects.name as project_name',
                'persons.name as client_name',
                'users.name as owner_name',
                'proposals.proposal_date',
                'proposals.value',
                'proposals.status'
            );
    }

    /**
     * Add columns.
     *
     * @return void
     */
    public function prepareColumns(): void
    {
        $this->addColumn([
            'index'      => 'proposal_id',
            'label'      => trans('admin::app.proposals.index.datagrid.proposal-id'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'project_name',
            'label'      => trans('admin::app.proposals.index.datagrid.project-name'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'client_name',
            'label'      => trans('admin::app.proposals.index.datagrid.client-name'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'owner_name',
            'label'      => trans('admin::app.proposals.index.datagrid.project-owner'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'proposal_date',
            'label'      => trans('admin::app.proposals.index.datagrid.proposal-date'),
            'type'       => 'date',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'value',
            'label'      => trans('admin::app.proposals.index.datagrid.value'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
            'closure'    => fn ($row) => core()->formatBasePrice($row->value),
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => trans('admin::app.proposals.index.datagrid.status'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                $labels = [
                    'draft'    => 'Draft',
                    'sent'     => 'Sent',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                    'signed'   => 'Signed',
                ];

                return $labels[$row->status] ?? $row->status;
            },
        ]);
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    public function prepareActions(): void
    {
        $this->addAction([
            'index'  => 'edit',
            'icon'   => 'icon-edit',
            'title'  => trans('admin::app.proposals.index.datagrid.edit'),
            'method' => 'GET',
            'url'    => fn ($row) => route('admin.proposals.edit', $row->id),
        ]);

        $this->addAction([
            'index'  => 'delete',
            'icon'   => 'icon-delete',
            'title'  => trans('admin::app.proposals.index.datagrid.delete'),
            'method' => 'DELETE',
            'url'    => fn ($row) => route('admin.proposals.delete', $row->id),
        ]);
    }

    /**
     * Prepare mass actions.
     *
     * @return void
     */
    public function prepareMassActions(): void
    {
        $this->addMassAction([
            'icon'   => 'icon-delete',
            'title'  => trans('admin::app.proposals.index.datagrid.delete'),
            'method' => 'POST',
            'url'    => route('admin.proposals.mass_delete'),
        ]);
    }
}
