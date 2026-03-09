<x-admin::layouts>
    <x-slot:title>
        Project Handover
    </x-slot>

    <x-admin::form :action="route('admin.it_sales.handovers.store')">
        <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <div class="flex flex-col gap-2">
                <p class="text-xl font-bold dark:text-white">Initiate Project Handover</p>
            </div>
            <div class="flex items-center gap-x-2.5">
                <button type="submit" class="primary-button">Submit Handover</button>
            </div>
        </div>

        <div class="mt-3.5 rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
            <x-admin::form.control-group>
                <x-admin::form.control-group.label class="required">Lead</x-admin::form.control-group.label>
                <x-admin::form.control-group.control type="select" name="lead_id" value="{{ $lead_id }}" label="Lead">
                    <option value="">Select Lead</option>
                    @foreach(\Webkul\Lead\Models\Lead::all() as $lead)
                        <option value="{{ $lead->id }}" {{ $lead_id == $lead->id ? 'selected' : '' }}>{{ $lead->title }}</option>
                    @endforeach
                </x-admin::form.control-group.control>
            </x-admin::form.control-group>

            <x-admin::form.control-group>
                <x-admin::form.control-group.label class="required">Accepted Proposal</x-admin::form.control-group.label>
                <x-admin::form.control-group.control type="select" name="proposal_id" label="Proposal">
                    <option value="">Select Proposal</option>
                    @foreach(\Sharmindar\Core\ITSales\Models\Proposal::where('status', 'accepted')->get() as $proposal)
                        <option value="{{ $proposal->id }}">{{ $proposal->proposal_number }} - {{ $proposal->title }}</option>
                    @endforeach
                </x-admin::form.control-group.control>
            </x-admin::form.control-group>

            <x-admin::form.control-group>
                <x-admin::form.control-group.label>Handover Notes</x-admin::form.control-group.label>
                <x-admin::form.control-group.control type="textarea" name="handover_notes" label="Notes" placeholder="Instructions for project team..." />
            </x-admin::form.control-group>
        </div>
    </x-admin::form>
</x-admin::layouts>
