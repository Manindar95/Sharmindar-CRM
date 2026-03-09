<?php

namespace Sharmindar\Core\Department\Http\Controllers;

use Illuminate\Http\Request;
use Webkul\Admin\Http\Controllers\Controller;
use Sharmindar\Core\Department\Models\Department;
use Webkul\User\Repositories\UserRepository;

class DepartmentController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return datagrid(\Sharmindar\Core\Department\DataGrids\DepartmentDataGrid::class)->process();
        }

        return view('company_department::index');
    }

    public function create()
    {
        $departments = Department::all();
        $users = app(UserRepository::class)->all();
        return view('company_department::create', compact('departments', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|unique:departments,code|max:255',
            'manager_id' => 'nullable|exists:users,id',
            'parent_id' => 'nullable|exists:departments,id'
        ]);

        $data = $request->all();
        $data['code'] = $data['code'] ?: null;
        $data['manager_id'] = $data['manager_id'] ?: null;
        $data['parent_id'] = $data['parent_id'] ?: null;

        Department::create($data);

        session()->flash('success', 'Department created successfully.');

        return redirect()->route('company.core.department.index');
    }

    public function edit(Department $department)
    {
        $departments = Department::where('id', '!=', $department->id)->get();
        $users = app(UserRepository::class)->all();
        return view('company_department::edit', compact('department', 'departments', 'users'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:255|unique:departments,code,' . $department->id,
            'manager_id' => 'nullable|exists:users,id',
            'parent_id' => 'nullable|exists:departments,id|not_in:' . $department->id
        ]);

        $data = $request->all();
        $data['code'] = $data['code'] ?: null;
        $data['manager_id'] = $data['manager_id'] ?: null;
        $data['parent_id'] = $data['parent_id'] ?: null;

        $department->update($data);

        session()->flash('success', 'Department updated successfully.');

        return redirect()->route('company.core.department.index');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        session()->flash('success', 'Department deleted successfully.');

        return redirect()->route('company.core.department.index');
    }
}
