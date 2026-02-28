<?php

namespace Webkul\Admin\Http\Controllers\Task;

use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Webkul\Admin\DataGrids\Task\TaskDataGrid;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\Models\Task;
use Webkul\Admin\Models\Project;

class TaskController extends Controller
{
    public function index(): View|JsonResponse
    {
        if (request()->ajax()) {
            return datagrid(TaskDataGrid::class)->process();
        }

        $projects = Project::pluck('name', 'id');
        $users = \Webkul\User\Models\User::pluck('name', 'id');

        return view('admin::tasks.index', compact('projects', 'users'));
    }

    public function create(): View
    {
        $projects = Project::pluck('name', 'id');
        $users = \Webkul\User\Models\User::pluck('name', 'id');

        return view('admin::tasks.create', compact('projects', 'users'));
    }

    public function store(): \Illuminate\Http\RedirectResponse
    {
        $this->validate(request(), [
            'title'       => 'required|string|max:255',
            'project_id'  => 'nullable|exists:projects,id',
            'status'      => 'required|in:pending,in_progress,completed',
            'priority'    => 'required|in:low,medium,high',
            'due_date'    => 'nullable|date',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        Task::create(request()->only(['title', 'description', 'project_id', 'status', 'priority', 'due_date', 'assigned_to']));

        session()->flash('success', trans('admin::app.tasks.index.create-success'));

        return redirect()->route('admin.tasks.index');
    }

    public function edit(int $id): View
    {
        $task = Task::findOrFail($id);
        $projects = Project::pluck('name', 'id');
        $users = \Webkul\User\Models\User::pluck('name', 'id');

        return view('admin::tasks.edit', compact('task', 'projects', 'users'));
    }

    public function update(int $id): \Illuminate\Http\RedirectResponse
    {
        $this->validate(request(), [
            'title'       => 'required|string|max:255',
            'project_id'  => 'nullable|exists:projects,id',
            'status'      => 'required|in:pending,in_progress,completed',
            'priority'    => 'required|in:low,medium,high',
            'due_date'    => 'nullable|date',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $task = Task::findOrFail($id);
        $task->update(request()->only(['title', 'description', 'project_id', 'status', 'priority', 'due_date', 'assigned_to']));

        session()->flash('success', trans('admin::app.tasks.index.update-success'));

        return redirect()->route('admin.tasks.index');
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            Task::findOrFail($id)->delete();

            return new JsonResponse(['message' => trans('admin::app.tasks.index.delete-success')]);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => trans('admin::app.tasks.index.delete-failed')], 400);
        }
    }

    public function massDestroy(): JsonResponse
    {
        $indices = request()->input('indices', []);

        foreach ($indices as $id) {
            Task::find($id)?->delete();
        }

        return new JsonResponse(['message' => trans('admin::app.tasks.index.delete-success')]);
    }
}
