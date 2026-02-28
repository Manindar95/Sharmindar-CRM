<?php

namespace Webkul\Admin\Http\Controllers\Project;

use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Webkul\Admin\DataGrids\Project\ProjectDataGrid;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\Models\Project;

class ProjectController extends Controller
{
    public function index(): View|JsonResponse
    {
        if (request()->ajax()) {
            return datagrid(ProjectDataGrid::class)->process();
        }

        return view('admin::projects.index');
    }

    public function create(): View
    {
        return view('admin::projects.create');
    }

    public function store(): \Illuminate\Http\RedirectResponse
    {
        $this->validate(request(), [
            'name'       => 'required|string|max:255',
            'status'     => 'required|in:not_started,in_progress,on_hold,completed',
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
        ]);

        Project::create(request()->only(['name', 'description', 'status', 'start_date', 'end_date']));

        session()->flash('success', trans('admin::app.projects.index.create-success'));

        return redirect()->route('admin.projects.index');
    }

    public function edit(int $id): View
    {
        $project = Project::findOrFail($id);

        return view('admin::projects.edit', compact('project'));
    }

    public function update(int $id): \Illuminate\Http\RedirectResponse
    {
        $this->validate(request(), [
            'name'       => 'required|string|max:255',
            'status'     => 'required|in:not_started,in_progress,on_hold,completed',
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
        ]);

        $project = Project::findOrFail($id);
        $project->update(request()->only(['name', 'description', 'status', 'start_date', 'end_date']));

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
