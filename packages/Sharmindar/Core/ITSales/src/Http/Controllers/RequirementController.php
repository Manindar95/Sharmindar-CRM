<?php

namespace Sharmindar\Core\ITSales\Http\Controllers;

use Sharmindar\Core\ITSales\Models\Requirement;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Webkul\Admin\Http\Controllers\Controller;

class RequirementController extends Controller
{
    public function index()
    {
        $requirements = Requirement::with(['lead', 'proposal', 'creator'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('it_sales::requirements.index', compact('requirements'));
    }

    public function create(?int $lead_id = null)
    {
        return view('it_sales::requirements.create', compact('lead_id'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'lead_id' => 'nullable|exists:leads,id',
            'proposal_id' => 'nullable|exists:proposals,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:functional,non_functional,technical,business,integration',
            'priority' => 'required|in:must_have,should_have,nice_to_have',
            'complexity' => 'required|in:low,medium,high,very_high',
            'estimated_hours' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        Requirement::create([
            ...$validated,
            'created_by' => auth()->guard('user')->id(),
        ]);

        session()->flash('success', 'Requirement created.');

        return redirect()->route('admin.it_sales.requirements.index');
    }

    public function edit(int $id)
    {
        $requirement = Requirement::with(['lead', 'proposal'])->findOrFail($id);

        return view('it_sales::requirements.edit', compact('requirement'));
    }

    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:functional,non_functional,technical,business,integration',
            'priority' => 'required|in:must_have,should_have,nice_to_have',
            'complexity' => 'required|in:low,medium,high,very_high',
            'status' => 'nullable|in:gathered,analyzed,approved,deferred,rejected',
            'estimated_hours' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        Requirement::findOrFail($id)->update($validated);

        session()->flash('success', 'Requirement updated.');

        return redirect()->route('admin.it_sales.requirements.index');
    }

    public function destroy(int $id): JsonResponse
    {
        Requirement::findOrFail($id)->delete();

        return response()->json(['message' => 'Requirement deleted.']);
    }
}
