<?php

namespace Sharmindar\Core\ITSales\Http\Controllers;

use Sharmindar\Core\ITSales\Models\Approval;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sharmindar\Core\Admin\Http\Controllers\Controller;

class ApprovalController extends Controller
{
    public function index()
    {
        $approvals = Approval::with(['approvable', 'approver'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('it_sales::approvals.index', compact('approvals'));
    }

    public function approve(int $id): \Illuminate\Http\RedirectResponse
    {
        $approval = Approval::findOrFail($id);

        $approval->update([
            'status' => 'approved',
            'approver_id' => auth()->guard('user')->id(),
            'approved_at' => now(),
        ]);

        session()->flash('success', 'Approved successfully.');

        return redirect()->back();
    }

    public function reject(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $approval = Approval::findOrFail($id);

        $approval->update([
            'status' => 'rejected',
            'approver_id' => auth()->guard('user')->id(),
            'rejection_reason' => $request->reason,
            'approved_at' => now(),
        ]);

        session()->flash('error', 'Rejected.');

        return redirect()->back();
    }
}
