<?php

namespace Webkul\Admin\Http\Controllers\Timesheet;

use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Webkul\Admin\DataGrids\Timesheet\TimesheetDataGrid;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\Models\Timesheet;
use Webkul\Admin\Models\Project;
use Webkul\Admin\Models\Task;

class TimesheetController extends Controller
{
    public function index(): View|JsonResponse
    {
        if (request()->ajax()) {
            return datagrid(TimesheetDataGrid::class)->process();
        }

        $projects = Project::pluck('name', 'id');
        $tasks = Task::pluck('title', 'id');
        $users = \Webkul\User\Models\User::pluck('name', 'id');

        return view('admin::timesheets.index', compact('projects', 'tasks', 'users'));
    }

    public function create(): View
    {
        $projects = Project::pluck('name', 'id');
        $tasks = Task::pluck('title', 'id');
        $users = \Webkul\User\Models\User::pluck('name', 'id');

        return view('admin::timesheets.create', compact('projects', 'tasks', 'users'));
    }

    public function store(): \Illuminate\Http\RedirectResponse
    {
        $this->validate(request(), [
            'project_id' => 'nullable|exists:projects,id',
            'task_id'    => 'nullable|exists:tasks,id',
            'user_id'    => 'required|exists:users,id',
            'date'       => 'required|date',
            'hours'      => 'required|numeric|min:0.25|max:24',
        ]);

        Timesheet::create(request()->only(['project_id', 'task_id', 'user_id', 'date', 'hours', 'description']));

        session()->flash('success', trans('admin::app.timesheets.index.create-success'));

        return redirect()->route('admin.timesheets.index');
    }

    public function edit(int $id): View
    {
        $timesheet = Timesheet::findOrFail($id);
        $projects = Project::pluck('name', 'id');
        $tasks = Task::pluck('title', 'id');
        $users = \Webkul\User\Models\User::pluck('name', 'id');

        return view('admin::timesheets.edit', compact('timesheet', 'projects', 'tasks', 'users'));
    }

    public function update(int $id): \Illuminate\Http\RedirectResponse
    {
        $this->validate(request(), [
            'project_id' => 'nullable|exists:projects,id',
            'task_id'    => 'nullable|exists:tasks,id',
            'user_id'    => 'required|exists:users,id',
            'date'       => 'required|date',
            'hours'      => 'required|numeric|min:0.25|max:24',
        ]);

        $timesheet = Timesheet::findOrFail($id);
        $timesheet->update(request()->only(['project_id', 'task_id', 'user_id', 'date', 'hours', 'description']));

        session()->flash('success', trans('admin::app.timesheets.index.update-success'));

        return redirect()->route('admin.timesheets.index');
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            Timesheet::findOrFail($id)->delete();

            return new JsonResponse(['message' => trans('admin::app.timesheets.index.delete-success')]);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => trans('admin::app.timesheets.index.delete-failed')], 400);
        }
    }

    public function massDestroy(): JsonResponse
    {
        $indices = request()->input('indices', []);

        foreach ($indices as $id) {
            Timesheet::find($id)?->delete();
        }

        return new JsonResponse(['message' => trans('admin::app.timesheets.index.delete-success')]);
    }
}
