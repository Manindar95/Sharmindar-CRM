<?php

namespace Sharmindar\Core\User\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\User\Repositories\UserRepository;
use Webkul\User\Repositories\RoleRepository;
use Illuminate\Support\Facades\Log;
use Sharmindar\Core\User\Models\EmployeeProfile;
use Sharmindar\Core\User\Models\UserMeta;
use Sharmindar\Core\Department\Models\Department;
use Webkul\User\Models\UserProxy;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected
        UserRepository $userRepository, protected
        RoleRepository $roleRepository
        )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            return datagrid(\Sharmindar\Core\User\DataGrids\EmployeeDataGrid::class)->process();
        }

        return view('company_user::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $managers = UserProxy::where('status', 1)->get();

        return view('company_user::create', compact('departments', 'managers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        Log::info('EmployeeController@store started', request()->all());

        try {
            $this->validate(request(), [
                'email' => 'required|email|unique:users,email',
                'name' => 'required',
                'password' => 'required|min:6',
                'role_id' => 'required',
                'status' => 'boolean',
                'job_title' => 'required|string',
                'joining_date' => 'required|date',
                'salary_type' => 'required|in:hourly,daily,weekly,monthly',
                'salary_amount' => 'required|numeric',
                'department_name' => 'nullable|string',
                'reporting_manager_id' => 'nullable|exists:users,id',
                'contact_number' => 'nullable|string',
                'address' => 'nullable|string',
                'skills' => 'nullable|string',
                'experience_years' => 'nullable|numeric|min:0',
                'image' => 'nullable|image',
            ]);
        }
        catch (\Exception $e) {
            Log::error('Validation failed', ['errors' => $e->getMessage()]);
            throw $e;
        }

        $data = request()->all();

        if (request()->hasFile('image')) {
            $data['image'] = request()->file('image')->store('users');
            Log::info('Image stored: ' . $data['image']);
        }

        $data['password'] = bcrypt($data['password']);

        Event::dispatch('company.core.user.employee.create.before');

        try {
            DB::beginTransaction();

            $user = $this->userRepository->create($data);
            Log::info('User created: ' . $user->id);

            $departmentId = null;
            if (!empty($data['department_name'])) {
                $department = Department::firstOrCreate(['name' => $data['department_name']]);
                $departmentId = $department->id;
            }

            $profile = EmployeeProfile::create([
                'user_id' => $user->id,
                'job_title' => $data['job_title'],
                'department_id' => $departmentId,
                'reporting_manager_id' => !empty($data['reporting_manager_id']) ? $data['reporting_manager_id'] : null,
                'joining_date' => $data['joining_date'],
                'skills' => $data['skills'] ?? null,
                'experience_years' => $data['experience_years'] ?? 0,
                'salary_type' => $data['salary_type'],
                'salary_amount' => $data['salary_amount'],
                'contact_number' => $data['contact_number'] ?? null,
                'address' => $data['address'] ?? null,
            ]);
            Log::info('EmployeeProfile created: ' . $profile->id);

            if (isset($data['meta']) && is_array($data['meta'])) {
                foreach ($data['meta'] as $key => $value) {
                    UserMeta::create([
                        'user_id' => $user->id,
                        'key' => $key,
                        'value' => $value,
                    ]);
                }
            }

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error('Employee creation failed', ['error' => $e->getMessage()]);
            session()->flash('error', 'Failed to create employee. Please try again.');
            return redirect()->back()->withInput();
        }

        Event::dispatch('company.core.user.employee.create.after', $user);

        session()->flash('success', 'Employee created successfully.');

        return redirect()->route('company.core.user.employees.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = $this->userRepository->findOrFail($id);
        $departments = Department::all();
        $managers = UserProxy::where('status', 1)->get();

        return view('company_user::edit', compact('employee', 'departments', 'managers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $this->validate(request(), [
            'email' => 'required|email|unique:users,email,' . $id,
            'name' => 'required',
            'password' => 'nullable|min:6',
            'role_id' => 'required',
            'status' => 'boolean',
            'job_title' => 'required|string',
            'joining_date' => 'required|date',
            'salary_type' => 'required|in:hourly,daily,weekly,monthly',
            'salary_amount' => 'required|numeric',
            'department_name' => 'nullable|string',
            'reporting_manager_id' => 'nullable|exists:users,id',
            'contact_number' => 'nullable|string',
            'address' => 'nullable|string',
            'skills' => 'nullable|string',
            'experience_years' => 'nullable|numeric|min:0',
            'image' => 'nullable|image',
        ]);

        $data = request()->all();

        if (isset($data['password']) && $data['password']) {
            $data['password'] = bcrypt($data['password']);
        }
        else {
            unset($data['password']);
        }

        if (request()->hasFile('image')) {
            $user = $this->userRepository->find($id);
            if ($user->image) {
                Storage::delete($user->image);
            }
            $data['image'] = request()->file('image')->store('users');
        }

        Event::dispatch('company.core.user.employee.update.before', $id);

        try {
            DB::beginTransaction();

            $user = $this->userRepository->update($data, $id);

            $departmentId = null;
            if (!empty($data['department_name'])) {
                $department = Department::firstOrCreate(['name' => $data['department_name']]);
                $departmentId = $department->id;
            }

            EmployeeProfile::updateOrCreate(
            ['user_id' => $id],
            [
                'job_title' => $data['job_title'],
                'department_id' => $departmentId,
                'reporting_manager_id' => !empty($data['reporting_manager_id']) ? $data['reporting_manager_id'] : null,
                'joining_date' => $data['joining_date'],
                'skills' => $data['skills'] ?? null,
                'experience_years' => $data['experience_years'] ?? 0,
                'salary_type' => $data['salary_type'],
                'salary_amount' => $data['salary_amount'],
                'contact_number' => $data['contact_number'] ?? null,
                'address' => $data['address'] ?? null,
            ]
            );

            if (isset($data['meta']) && is_array($data['meta'])) {
                foreach ($data['meta'] as $key => $value) {
                    UserMeta::updateOrCreate(
                    ['user_id' => $id, 'key' => $key],
                    ['value' => $value]
                    );
                }
            }

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error('Employee update failed', ['error' => $e->getMessage()]);
            session()->flash('error', 'Failed to update employee. Please try again.');
            return redirect()->back()->withInput();
        }

        Event::dispatch('company.core.user.employee.update.after', $user);

        session()->flash('success', 'Employee updated successfully.');

        return redirect()->route('company.core.user.employees.index');
    }
}
