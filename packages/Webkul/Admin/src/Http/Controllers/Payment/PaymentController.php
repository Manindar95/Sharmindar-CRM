<?php

namespace Webkul\Admin\Http\Controllers\Payment;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\View\View;
use Webkul\Admin\DataGrids\Payment\PaymentDataGrid;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\Models\Payment;
use Webkul\Admin\Models\Project;
use Webkul\User\Models\User;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse|BinaryFileResponse
    {
        if (request()->ajax()) {
            return datagrid(PaymentDataGrid::class)->process();
        }

        return view('admin::payments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        $projects = Project::all();
        $users = User::all();

        return view('admin::payments.create', compact('projects', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(): \Illuminate\Http\RedirectResponse
    {
        $this->validate(request(), [
            'invoice_id'            => 'required|string|max:255',
            'project_id'            => 'required|exists:projects,id',
            'invoice_date'          => 'required|date',
            'invoice_amount'        => 'required|numeric|min:0',
            'due_date'              => 'nullable|date|after_or_equal:invoice_date',
            'payment_status'        => 'required|string',
            'payment_received_date' => 'nullable|date|after_or_equal:invoice_date',
            'followup_owner_id'     => 'nullable|exists:users,id',
        ]);

        Payment::create(request()->all());

        session()->flash('success', trans('admin::app.payments.create-success'));

        return redirect()->route('admin.payments.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit(int $id): View
    {
        $payment = Payment::findOrFail($id);
        $projects = Project::all();
        $users = User::all();

        return view('admin::payments.edit', compact('payment', 'projects', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id): \Illuminate\Http\RedirectResponse
    {
        $this->validate(request(), [
            'invoice_id'            => 'required|string|max:255',
            'project_id'            => 'required|exists:projects,id',
            'invoice_date'          => 'required|date',
            'invoice_amount'        => 'required|numeric|min:0',
            'due_date'              => 'nullable|date|after_or_equal:invoice_date',
            'payment_status'        => 'required|string',
            'payment_received_date' => 'nullable|date|after_or_equal:invoice_date',
            'followup_owner_id'     => 'nullable|exists:users,id',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->update(request()->all());

        session()->flash('success', trans('admin::app.payments.update-success'));

        return redirect()->route('admin.payments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            Payment::findOrFail($id)->delete();

            return new JsonResponse(['message' => trans('admin::app.payments.delete-success')]);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => trans('admin::app.payments.delete-failed')], 400);
        }
    }

    /**
     * Mass delete the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function massDestroy(): JsonResponse
    {
        $indices = request()->input('indices', []);

        foreach ($indices as $id) {
            Payment::find($id)?->delete();
        }

        return new JsonResponse(['message' => trans('admin::app.payments.delete-success')]);
    }
}
