<?php

namespace Sharmindar\Core\ITSales\Http\Controllers;

use Sharmindar\Core\ITSales\Models\Proposal;
use Sharmindar\Core\ITSales\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Webkul\Admin\Http\Controllers\Controller;

class ProposalController extends Controller
{
    public function index()
    {
        $proposals = Proposal::with(['lead', 'preparedBy'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('it_sales::proposals.index', compact('proposals'));
    }

    public function create(?int $lead_id = null)
    {
        $services = Service::where('is_active', true)->get();

        return view('it_sales::proposals.create', compact('services', 'lead_id'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'lead_id' => 'nullable|exists:leads,id',
            'executive_summary' => 'nullable|string',
            'scope_of_work' => 'nullable|string',
            'deliverables' => 'nullable|array',
            'timeline_weeks' => 'nullable|integer|min:1',
            'valid_until' => 'nullable|date|after:today',
            'terms_and_conditions' => 'nullable|string',
            'items' => 'nullable|array',
            'items.*.service_id' => 'nullable|exists:services,id',
            'items.*.description' => 'nullable|string',
            'items.*.quantity' => 'required_with:items|numeric|min:0',
            'items.*.unit_price' => 'required_with:items|numeric|min:0',
        ]);

        $proposal = Proposal::create([
            ...$validated,
            'prepared_by' => auth()->guard('user')->id(),
            'status' => 'draft',
            'total_amount' => 0,
        ]);

        $totalAmount = 0;
        if (!empty($validated['items'])) {
            foreach ($validated['items'] as $item) {
                $lineTotal = ($item['quantity'] ?? 0) * ($item['unit_price'] ?? 0);
                $totalAmount += $lineTotal;
                $proposal->items()->create([
                    'service_id' => $item['service_id'] ?? null,
                    'description' => $item['description'] ?? '',
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total' => $lineTotal,
                ]);
            }
        }

        $proposal->update(['total_amount' => $totalAmount]);

        session()->flash('success', "Proposal {$proposal->proposal_number} created successfully.");

        return redirect()->route('admin.it_sales.proposals.index');
    }

    public function edit(int $id)
    {
        $proposal = Proposal::with(['items.service', 'lead'])->findOrFail($id);
        $services = Service::where('is_active', true)->get();

        return view('it_sales::proposals.edit', compact('proposal', 'services'));
    }

    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $proposal = Proposal::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'executive_summary' => 'nullable|string',
            'scope_of_work' => 'nullable|string',
            'deliverables' => 'nullable|array',
            'timeline_weeks' => 'nullable|integer|min:1',
            'valid_until' => 'nullable|date',
            'terms_and_conditions' => 'nullable|string',
            'items' => 'nullable|array',
            'items.*.service_id' => 'nullable|exists:services,id',
            'items.*.description' => 'nullable|string',
            'items.*.quantity' => 'required_with:items|numeric|min:0',
            'items.*.unit_price' => 'required_with:items|numeric|min:0',
        ]);

        $proposal->update($validated);

        $proposal->items()->delete();
        $totalAmount = 0;
        if (!empty($validated['items'])) {
            foreach ($validated['items'] as $item) {
                $lineTotal = ($item['quantity'] ?? 0) * ($item['unit_price'] ?? 0);
                $totalAmount += $lineTotal;
                $proposal->items()->create([
                    'service_id' => $item['service_id'] ?? null,
                    'description' => $item['description'] ?? '',
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total' => $lineTotal,
                ]);
            }
        }

        $proposal->update(['total_amount' => $totalAmount]);

        session()->flash('success', "Proposal {$proposal->proposal_number} updated.");

        return redirect()->route('admin.it_sales.proposals.index');
    }

    public function destroy(int $id): JsonResponse
    {
        Proposal::findOrFail($id)->delete();

        return response()->json(['message' => 'Proposal deleted.']);
    }

    public function send(int $id): \Illuminate\Http\RedirectResponse
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->update(['status' => 'sent_to_client']);

        session()->flash('success', "Proposal {$proposal->proposal_number} sent to client.");

        return redirect()->route('admin.it_sales.proposals.index');
    }

    public function revise(int $id): \Illuminate\Http\RedirectResponse
    {
        $original = Proposal::with('items')->findOrFail($id);

        $revision = $original->replicate();
        $revision->parent_id = $original->id;
        $revision->version = $original->version + 1;
        $revision->status = 'draft';
        $revision->proposal_number = null;
        $revision->save();

        foreach ($original->items as $item) {
            $revision->items()->create($item->only([
                'service_id', 'description', 'quantity', 'unit_price', 'total',
            ]));
        }

        $original->update(['status' => 'revision_requested']);

        session()->flash('success', "Revision v{$revision->version} ({$revision->proposal_number}) created.");

        return redirect()->route('admin.it_sales.proposals.edit', $revision->id);
    }

    public function print(int $id)
    {
        $proposal = Proposal::with(['items.service', 'lead.person', 'preparedBy'])->findOrFail($id);

        return view('it_sales::proposals.print', compact('proposal'));
    }
}
