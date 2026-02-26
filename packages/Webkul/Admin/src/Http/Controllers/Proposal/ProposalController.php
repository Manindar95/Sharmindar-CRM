<?php

namespace Webkul\Admin\Http\Controllers\Proposal;

use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Webkul\Admin\DataGrids\Proposal\ProposalDataGrid;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\Models\Proposal;
use Webkul\Admin\Models\Project;
use Webkul\Contact\Models\Person;
use Webkul\User\Models\User;
use Webkul\Admin\Notifications\Proposal\Signed as ProposalSignedNotification;
use Webkul\Admin\Notifications\Proposal\Created as ProposalCreatedNotification;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        if (request()->ajax()) {
            return datagrid(ProposalDataGrid::class)->process();
        }

        return view('admin::proposals.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        $projects = Project::all();
        $persons = Person::all();
        $users = User::all();

        return view('admin::proposals.create', compact('projects', 'persons', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(): \Illuminate\Http\RedirectResponse
    {
        $this->validate(request(), [
            'proposal_id'           => 'required|unique:proposals,proposal_id',
            'project_id'            => 'required|exists:projects,id',
            'person_id'             => 'required|exists:persons,id',
            'user_id'               => 'required|exists:users,id',
            'proposal_date'         => 'required|date',
            'value'                 => 'required|numeric',
            'status'                => 'required|in:draft,sent,approved,rejected,signed',
            'ceo_approved_at'       => 'nullable|date',
            'manager_approved_at'   => 'nullable|date',
            'shared_with_client_at' => 'nullable|date',
            'client_signed_at'      => 'nullable|date',
        ]);

        $proposal = Proposal::create(request()->all());

        if ($proposal->user) {
            if ($proposal->status === 'signed') {
                $proposal->user->notify(new ProposalSignedNotification(['proposal' => $proposal]));
            } else {
                $proposal->user->notify(new ProposalCreatedNotification(['proposal' => $proposal]));
            }
        }

        session()->flash('success', trans('admin::app.proposals.index.create-success'));

        return redirect()->route('admin.proposals.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit(int $id): View
    {
        $proposal = Proposal::findOrFail($id);
        
        $projects = Project::all();
        $persons = Person::all();
        $users = User::all();

        return view('admin::proposals.edit', compact('proposal', 'projects', 'persons', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id): \Illuminate\Http\RedirectResponse
    {
        $this->validate(request(), [
            'proposal_id'           => 'required|unique:proposals,proposal_id,' . $id,
            'project_id'            => 'required|exists:projects,id',
            'person_id'             => 'required|exists:persons,id',
            'user_id'               => 'required|exists:users,id',
            'proposal_date'         => 'required|date',
            'value'                 => 'required|numeric',
            'status'                => 'required|in:draft,sent,approved,rejected,signed',
            'ceo_approved_at'       => 'nullable|date',
            'manager_approved_at'   => 'nullable|date',
            'shared_with_client_at' => 'nullable|date',
            'client_signed_at'      => 'nullable|date',
        ]);

        $proposal = Proposal::findOrFail($id);
        $oldStatus = $proposal->status;
        $proposal->update(request()->all());

        if ($oldStatus !== 'signed' && $proposal->status === 'signed' && $proposal->user) {
            $proposal->user->notify(new ProposalSignedNotification(['proposal' => $proposal]));
        }

        session()->flash('success', trans('admin::app.proposals.index.update-success'));

        return redirect()->route('admin.proposals.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            Proposal::findOrFail($id)->delete();

            return new JsonResponse(['message' => trans('admin::app.proposals.index.delete-success')]);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => trans('admin::app.proposals.index.delete-failed')], 400);
        }
    }

    /**
     * Mass destroy the specified resources from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function massDestroy(): JsonResponse
    {
        $indices = request()->input('indices', []);

        foreach ($indices as $id) {
            Proposal::find($id)?->delete();
        }

        return new JsonResponse(['message' => trans('admin::app.proposals.index.delete-success')]);
    }
}
