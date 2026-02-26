<?php

namespace Webkul\Admin\DataGrids\Payment;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class PaymentDataGrid extends DataGrid
{
    public function prepareQueryBuilder(): Builder
    {
        return DB::table('payments')
            ->leftJoin('projects', 'payments.project_id', '=', 'projects.id')
            ->leftJoin('users', 'payments.followup_owner_id', '=', 'users.id')
            ->select(
                'payments.id',
                'payments.invoice_id',
                'projects.name as project_name',
                'payments.invoice_date',
                'payments.invoice_amount',
                'payments.due_date',
                'payments.payment_status',
                'payments.payment_received_date',
                'users.name as owner_name'
            );
    }

    public function prepareColumns(): void
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.payments.datagrid.id'),
            'type'       => 'integer',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'invoice_id',
            'label'      => trans('admin::app.payments.datagrid.invoice-id'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'project_name',
            'label'      => trans('admin::app.payments.datagrid.project-name'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'invoice_date',
            'label'      => trans('admin::app.payments.datagrid.invoice-date'),
            'type'       => 'date',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'invoice_amount',
            'label'      => trans('admin::app.payments.datagrid.invoice-amount'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
            'closure'    => fn ($row) => core()->formatPrice($row->invoice_amount),
        ]);

        $this->addColumn([
            'index'      => 'due_date',
            'label'      => trans('admin::app.payments.datagrid.due-date'),
            'type'       => 'date',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'payment_status',
            'label'      => trans('admin::app.payments.datagrid.payment-status'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'payment_received_date',
            'label'      => trans('admin::app.payments.datagrid.payment-received-date'),
            'type'       => 'date',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'owner_name',
            'label'      => trans('admin::app.payments.datagrid.followup-owner'),
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
            'title'  => trans('admin::app.payments.datagrid.edit'),
            'method' => 'GET',
            'url'    => fn ($row) => route('admin.payments.edit', $row->id),
        ]);

        $this->addAction([
            'index'  => 'delete',
            'icon'   => 'icon-delete',
            'title'  => trans('admin::app.payments.datagrid.delete'),
            'method' => 'DELETE',
            'url'    => fn ($row) => route('admin.payments.delete', $row->id),
        ]);
    }

    public function prepareMassActions(): void
    {
        $this->addMassAction([
            'icon'   => 'icon-delete',
            'title'  => trans('admin::app.payments.datagrid.delete'),
            'method' => 'POST',
            'url'    => route('admin.payments.mass_delete'),
        ]);
    }
}
