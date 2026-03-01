<?php

namespace Company\Core\ITSales\Http\Controllers;

use Company\Core\ITSales\Models\Proposal;
use Company\Core\ITSales\Models\ProjectHandover;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Lead\Models\Lead;

class ProjectHandoverController extends Controller
{
    public function index()
    {
        $handovers = ProjectHandover::with(['lead', 'proposal', 'project', 'handedOverBy'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('it_sales::handovers.index', compact('handovers'));
    }

    public function create(?int $lead_id = null)
    {
        $proposals = Proposal::where('status', 'accepted');
        if ($lead_id) {
            $proposals = $proposals->where('lead_id', $lead_id);
        }

        $proposals = $proposals->get();

        return view('it_sales::handovers.create', compact('proposals', 'lead_id'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'proposal_id' => 'required|exists:proposals,id',
            'handover_notes' => 'nullable|string',
        ]);

        $proposal = Proposal::findOrFail($validated['proposal_id']);

        // Mock project creation if Webkul\Project doesn't exist or just create a placeholder logic
        // For now, let's assume we just want to record the handover

        ProjectHandover::create([
            'lead_id' => $validated['lead_id'],
            'proposal_id' => $validated['proposal_id'],
            'project_id' => null, // Project creation logic might need Webkul\Project package
            'handover_status' => 'in_progress',
            'handover_notes' => $validated['handover_notes'] ?? null,
            'handed_over_by' => auth()->guard('user')->id(),
        ]);

        session()->flash('success', 'Project handover initiated.');

        return redirect()->route('admin.it_sales.handovers.index');
    }

    public function show(int $id)
    {
        $handover = ProjectHandover::with(['lead', 'proposal.items', 'project', 'handedOverBy', 'receivedBy'])
            ->findOrFail($id);

        return view('it_sales::handovers.show', compact('handover'));
    }

    public function complete(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $handover = ProjectHandover::findOrFail($id);

        $handover->update([
            'handover_status' => 'completed',
            'received_by' => auth()->guard('user')->id(),
            'completed_at' => now(),
        ]);

        session()->flash('success', 'Handover completed.');

        return redirect()->route('admin.it_sales.handovers.index');
    }
}
