<x-admin::layouts>
    <x-slot:title>
        Edit Proposal
    </x-slot>

    <x-admin::form :action="route('admin.it_sales.proposals.update', $proposal->id)" method="PUT">
        <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <div class="flex flex-col gap-2">
                <p class="text-xl font-bold dark:text-white">Edit Proposal: {{ $proposal->proposal_number }}</p>
            </div>
            <div class="flex items-center gap-x-2.5">
                <button type="submit" class="primary-button">Update Proposal</button>
            </div>
        </div>

        <div class="mt-3.5 rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
            <x-admin::form.control-group>
                <x-admin::form.control-group.label class="required">Title</x-admin::form.control-group.label>
                <x-admin::form.control-group.control type="text" name="title" value="{{ old('title') ?? $proposal->title }}" rules="required" label="Title" />
                <x-admin::form.control-group.error control-name="title" />
            </x-admin::form.control-group>

            <x-admin::form.control-group>
                <x-admin::form.control-group.label>Executive Summary</x-admin::form.control-group.label>
                <x-admin::form.control-group.control type="textarea" name="executive_summary" value="{{ old('executive_summary') ?? $proposal->executive_summary }}" label="Executive Summary" />
            </x-admin::form.control-group>

            <x-admin::form.control-group>
                <x-admin::form.control-group.label>Scope of Work</x-admin::form.control-group.label>
                <x-admin::form.control-group.control type="textarea" name="scope_of_work" value="{{ old('scope_of_work') ?? $proposal->scope_of_work }}" label="Scope of Work" />
            </x-admin::form.control-group>
        </div>
    </x-admin::form>
</x-admin::layouts>
