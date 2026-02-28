<?php

namespace Company\Core\Department\Http\Controllers;

use Illuminate\Http\Request;
use Webkul\Admin\Http\Controllers\Controller;
use Company\Core\Department\Models\Designation;
use Company\Core\Department\Models\Department;

class DesignationController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return datagrid(\Company\Core\Department\DataGrids\DesignationDataGrid::class)->process();
        }

        return view('company_department::designations.index');
    }

    public function create()
    {
        $departments = Department::all();
        return view('company_department::designations.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:designations,code|max:255',
            'department_id' => 'nullable|exists:departments,id'
        ]);

        Designation::create($request->all());

        session()->flash('success', 'Designation created successfully.');

        return redirect()->route('company.core.department.designations.index');
    }

    public function edit(Designation $designation)
    {
        $departments = Department::all();
        return view('company_department::designations.edit', compact('designation', 'departments'));
    }

    public function update(Request $request, Designation $designation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:designations,code,' . $designation->id,
            'department_id' => 'nullable|exists:departments,id'
        ]);

        $designation->update($request->all());

        session()->flash('success', 'Designation updated successfully.');

        return redirect()->route('company.core.department.designations.index');
    }

    public function destroy(Designation $designation)
    {
        $designation->delete();

        session()->flash('success', 'Designation deleted successfully.');

        return redirect()->route('company.core.department.designations.index');
    }
}
