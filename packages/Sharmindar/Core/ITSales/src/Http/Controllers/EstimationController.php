<?php

namespace Sharmindar\Core\ITSales\Http\Controllers;

use Sharmindar\Core\ITSales\Models\Estimation;
use Sharmindar\Core\ITSales\Models\EstimationItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sharmindar\Core\Admin\Http\Controllers\Controller;

class EstimationController extends Controller
{
    public function index()
    {
        $estimations = Estimation::with(['proposal', 'estimator'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('it_sales::estimations.index', compact('estimations'));
    }

    public function create(?int $proposal_id = null)
    {
        return view('it_sales::estimations.create', compact('proposal_id'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'proposal_id' => 'required|exists:proposals,id',
            'buffer_percentage' => 'nullable|numeric|min:0|max:100',
            'assumptions' => 'nullable|string',
            'risks' => 'nullable|string',
            'items' => 'nullable|array',
            'items.*.requirement_id' => 'nullable|exists:requirements,id',
            'items.*.phase' => 'nullable|in:discovery,design,development,testing,deployment,support',
            'items.*.task_description' => 'nullable|string',
            'items.*.estimated_hours' => 'required_with:items|numeric|min:0',
            'items.*.role' => 'nullable|string',
            'items.*.hourly_rate' => 'nullable|numeric|min:0',
        ]);

        $estimation = Estimation::create([
            'proposal_id' => $validated['proposal_id'],
            'estimated_by' => auth()->guard('user')->id(),
            'buffer_percentage' => $validated['buffer_percentage'] ?? 20,
            'assumptions' => $validated['assumptions'] ?? null,
            'risks' => $validated['risks'] ?? null,
            'status' => 'draft',
        ]);

        if (!empty($validated['items'])) {
            foreach ($validated['items'] as $item) {
                $estimation->items()->create($item);
            }
        }

        $estimation->recalculate();

        session()->flash('success', 'Estimation created.');

        return redirect()->route('admin.it_sales.estimations.index');
    }

    public function edit(int $id)
    {
        $estimation = Estimation::with(['items.requirement', 'proposal'])->findOrFail($id);

        return view('it_sales::estimations.edit', compact('estimation'));
    }

    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $estimation = Estimation::findOrFail($id);

        $validated = $request->validate([
            'buffer_percentage' => 'nullable|numeric|min:0|max:100',
            'assumptions' => 'nullable|string',
            'risks' => 'nullable|string',
            'status' => 'nullable|in:draft,reviewed,approved',
            'items' => 'nullable|array',
            'items.*.requirement_id' => 'nullable|exists:requirements,id',
            'items.*.phase' => 'nullable|in:discovery,design,development,testing,deployment,support',
            'items.*.task_description' => 'nullable|string',
            'items.*.estimated_hours' => 'required_with:items|numeric|min:0',
            'items.*.role' => 'nullable|string',
            'items.*.hourly_rate' => 'nullable|numeric|min:0',
        ]);

        $estimation->update($validated);

        if (isset($validated['items'])) {
            $estimation->items()->delete();
            foreach ($validated['items'] as $item) {
                $estimation->items()->create($item);
            }
        }

        $estimation->recalculate();

        session()->flash('success', 'Estimation updated.');

        return redirect()->route('admin.it_sales.estimations.index');
    }

    public function destroy(int $id): JsonResponse
    {
        Estimation::findOrFail($id)->delete();

        return response()->json(['message' => 'Estimation deleted.']);
    }
}
