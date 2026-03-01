<x-admin::layouts>
    <x-slot:title>
        Create Estimation
    </x-slot>

    <x-admin::form :action="route('admin.it_sales.estimations.store')">
        <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <div class="flex flex-col gap-2">
                <p class="text-xl font-bold dark:text-white">Create Technical Estimation</p>
            </div>
            <div class="flex items-center gap-x-2.5">
                <button type="submit" class="primary-button">Save Estimation</button>
            </div>
        </div>

        <div class="mt-3.5 rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
            <x-admin::form.control-group>
                <x-admin::form.control-group.label class="required">Proposal</x-admin::form.control-group.label>
                <x-admin::form.control-group.control type="select" name="proposal_id" rules="required" label="Proposal">
                    <option value="">Select Proposal</option>
                    @foreach(\Company\Core\ITSales\Models\Proposal::all() as $proposal)
                        <option value="{{ $proposal->id }}" {{ $proposal_id == $proposal->id ? 'selected' : '' }}>{{ $proposal->proposal_number }} - {{ $proposal->title }}</option>
                    @endforeach
                </x-admin::form.control-group.control>
            </x-admin::form.control-group>

            <x-admin::form.control-group>
                <x-admin::form.control-group.label>Buffer Percentage (%)</x-admin::form.control-group.label>
                <x-admin::form.control-group.control type="text" name="buffer_percentage" value="20" label="Buffer" />
            </x-admin::form.control-group>

            <x-admin::form.control-group>
                <x-admin::form.control-group.label>Assumptions</x-admin::form.control-group.label>
                <x-admin::form.control-group.control type="textarea" name="assumptions" label="Assumptions" placeholder="Technical assumptions..." />
            </x-admin::form.control-group>
        </div>
    </x-admin::form>
</x-admin::layouts>
