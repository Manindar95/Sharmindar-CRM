<?php

namespace Sharmindar\Core\ITSales\Http\Controllers;

use Sharmindar\Core\ITSales\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sharmindar\Core\Admin\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderBy('name')->paginate(15);

        return view('it_sales::services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('it_sales::services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:development,design,consulting,maintenance,testing,devops',
            'billing_type' => 'required|in:fixed,hourly,monthly_retainer',
            'hourly_rate' => 'nullable|numeric|min:0',
            'fixed_price' => 'nullable|numeric|min:0',
            'technology_stack' => 'nullable|array',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        Service::create($validated);

        session()->flash('success', 'Service created successfully.');

        return redirect()->route('admin.it_sales.services.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $service = Service::findOrFail($id);

        return view('it_sales::services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:development,design,consulting,maintenance,testing,devops',
            'billing_type' => 'required|in:fixed,hourly,monthly_retainer',
            'hourly_rate' => 'nullable|numeric|min:0',
            'fixed_price' => 'nullable|numeric|min:0',
            'technology_stack' => 'nullable|array',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        Service::findOrFail($id)->update($validated);

        session()->flash('success', 'Service updated successfully.');

        return redirect()->route('admin.it_sales.services.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        Service::findOrFail($id)->delete();

        return response()->json(['message' => 'Service deleted successfully.']);
    }
}
