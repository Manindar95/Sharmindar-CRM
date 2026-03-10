<?php

namespace Sharmindar\Core\ITSales\Http\Controllers;

use Sharmindar\Core\Admin\Http\Controllers\Controller;
use Sharmindar\Core\ITSales\Models\LeadLifecycleStatus;
use Sharmindar\Core\ITSales\Models\LeadStatusTransition;
use Sharmindar\Core\ITSales\Notifications\StaleLeadNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sharmindar\Core\Lead\Models\Lead;
use Sharmindar\Core\User\Models\User;

class LeadLifecycleController extends Controller
{
    /**
     * List all lifecycle statuses.
     */
    public function statuses()
    {
        $statuses = LeadLifecycleStatus::orderBy('sort_order')->get();

        return view('it_sales::lifecycle.statuses', compact('statuses'));
    }

    public function storeStatus(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:lead_lifecycle_statuses,code',
            'color' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        LeadLifecycleStatus::create($validated);

        session()->flash('success', 'Status created.');

        return redirect()->route('admin.it_sales.lifecycle.statuses.index');
    }

    /**
     * Update an existing status.
     */
    public function updateStatus(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:lead_lifecycle_statuses,code,' . $id,
            'color' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        LeadLifecycleStatus::findOrFail($id)->update($validated);

        session()->flash('success', 'Status updated.');

        return redirect()->route('admin.it_sales.lifecycle.statuses.index');
    }

    /**
     * Delete a status.
     */
    public function deleteStatus(int $id)
    {
        LeadLifecycleStatus::findOrFail($id)->delete();

        return response()->json(['message' => 'Status deleted.']);
    }

    /**
     * Transition lead to a new status.
     */
    public function transition(Request $request, int $leadId)
    {
        $request->validate([
            'status_id' => 'required|exists:lead_lifecycle_statuses,id',
            'comment' => 'nullable|string',
        ]);

        $lead = Lead::findOrFail($leadId);
        $oldStatusId = $lead->extension->lifecycle_status_id ?? null;

        // Create transition audit trail
        LeadStatusTransition::create([
            'lead_id' => $leadId,
            'from_status_id' => $oldStatusId,
            'to_status_id' => $request->status_id,
            'user_id' => auth()->guard('user')->id(),
            'notes' => $request->comment,
            'transition_at' => now(),
        ]);

        // Update lead extension
        $lead->extension()->updateOrCreate(
        ['lead_id' => $leadId],
        ['lifecycle_status_id' => $request->status_id]
        );

        return response()->json(['message' => 'Lead transitioned successfully.']);
    }

    /**
     * Get transition history for a lead.
     */
    public function history(int $leadId)
    {
        $history = LeadStatusTransition::with(['fromStatus', 'toStatus', 'user'])
            ->where('lead_id', $leadId)
            ->orderByDesc('transition_at')
            ->get();

        return response()->json($history);
    }

    /**
     * Get stale leads (no update in 48 hrs).
     */
    public function staleLeads()
    {
        $staleLeads = Lead::where('updated_at', '<', now()->subHours(48))
            ->whereHas('extension', function ($q) {
            // Not in terminal statuses (Won/Lost/On Hold)
            $q->whereHas('lifecycleStatus', function ($sq) {
                    $sq->where('is_terminal', false);
                }
                );
            })
            ->with(['extension.lifecycleStatus', 'user'])
            ->get();

        return response()->json($staleLeads);
    }
}
