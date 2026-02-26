<?php

namespace Webkul\Admin\Http\Controllers\Project;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\View\View;
use Webkul\Admin\DataGrids\Project\ProjectDataGrid;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\Models\Project;
use Webkul\Contact\Models\Person;
use Webkul\User\Models\User;

class ProjectController extends Controller
{
    public function index(): View|JsonResponse|BinaryFileResponse
    {
        if (request()->ajax()) {
            return datagrid(ProjectDataGrid::class)->process();
        }

        return view('admin::projects.index');
    }

    public function create(): View
    {
        $persons = Person::all();
        $users = User::all();

        return view('admin::projects.create', compact('persons', 'users'));
    }

    public function store(): \Illuminate\Http\RedirectResponse
    {
        $this->validate(request(), [
            'name'              => 'required|string|max:255',
            'client_id'         => 'nullable|exists:persons,id',
            'project_type'      => 'nullable|string',
            'status'            => 'required|in:not_started,in_progress,on_hold,completed',
            'start_date'        => 'nullable|date',
            'end_date'          => 'nullable|date|after_or_equal:start_date',
            'expected_end_date' => 'nullable|date|after_or_equal:start_date',
            'actual_end_date'   => 'nullable|date|after_or_equal:start_date',
            'manager_id'        => 'nullable|exists:users,id',
            'owner_id'          => 'nullable|exists:users,id',
            'priority'          => 'nullable|in:low,medium,high',
            'team_type'         => 'nullable|in:internal,external',
        ]);

        $data = request()->all();

        // Convert empty strings to null for nullable foreign key and date fields
        $nullableFields = ['client_id', 'manager_id', 'owner_id', 'start_date', 'end_date', 'expected_end_date', 'actual_end_date'];
        foreach ($nullableFields as $field) {
            if (isset($data[$field]) && $data[$field] === '') {
                $data[$field] = null;
            }
        }

        Project::create($data);

        session()->flash('success', trans('admin::app.projects.index.create-success'));

        return redirect()->route('admin.projects.index');
    }

    public function edit(int $id): View
    {
        $project = Project::findOrFail($id);
        $persons = Person::all();
        $users = User::all();

        return view('admin::projects.edit', compact('project', 'persons', 'users'));
    }

    public function update(int $id): \Illuminate\Http\RedirectResponse
    {
        $this->validate(request(), [
            'name'              => 'required|string|max:255',
            'client_id'         => 'nullable|exists:persons,id',
            'project_type'      => 'nullable|string',
            'status'            => 'required|in:not_started,in_progress,on_hold,completed',
            'start_date'        => 'nullable|date',
            'end_date'          => 'nullable|date|after_or_equal:start_date',
            'expected_end_date' => 'nullable|date|after_or_equal:start_date',
            'actual_end_date'   => 'nullable|date|after_or_equal:start_date',
            'manager_id'        => 'nullable|exists:users,id',
            'owner_id'          => 'nullable|exists:users,id',
            'priority'          => 'nullable|in:low,medium,high',
            'team_type'         => 'nullable|in:internal,external',
        ]);

        $data = request()->all();

        // Convert empty strings to null for nullable foreign key and date fields
        $nullableFields = ['client_id', 'manager_id', 'owner_id', 'start_date', 'end_date', 'expected_end_date', 'actual_end_date'];
        foreach ($nullableFields as $field) {
            if (isset($data[$field]) && $data[$field] === '') {
                $data[$field] = null;
            }
        }

        $project = Project::findOrFail($id);
        $project->update($data);

        session()->flash('success', trans('admin::app.projects.index.update-success'));

        return redirect()->route('admin.projects.index');
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            Project::findOrFail($id)->delete();

            return new JsonResponse(['message' => trans('admin::app.projects.index.delete-success')]);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => trans('admin::app.projects.index.delete-failed')], 400);
        }
    }

    public function massDestroy(): JsonResponse
    {
        $indices = request()->input('indices', []);

        foreach ($indices as $id) {
            Project::find($id)?->delete();
        }

        return new JsonResponse(['message' => trans('admin::app.projects.index.delete-success')]);
    }
}
