<x-admin::layouts>
    <x-slot:title>
        Add Requirement
    </x-slot>

    <x-admin::form :action="route('admin.it_sales.requirements.store')">
        <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <div class="flex flex-col gap-2">
                <p class="text-xl font-bold dark:text-white">Add IT Requirement</p>
            </div>
            <div class="flex items-center gap-x-2.5">
                <button type="submit" class="primary-button">Save Requirement</button>
            </div>
        </div>

        <div class="mt-3.5 rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
            <x-admin::form.control-group>
                <x-admin::form.control-group.label class="required">Title</x-admin::form.control-group.label>
                <x-admin::form.control-group.control type="text" name="title" value="{{ old('title') }}" rules="required" label="Title" placeholder="Requirement Title" />
                <x-admin::form.control-group.error control-name="title" />
            </x-admin::form.control-group>

            <x-admin::form.control-group>
                <x-admin::form.control-group.label>Lead</x-admin::form.control-group.label>
                <x-admin::form.control-group.control type="select" name="lead_id" value="{{ $lead_id }}" label="Lead">
                    <option value="">Select Lead</option>
                    @foreach(\Sharmindar\Core\Lead\Models\Lead::all() as $lead)
                        <option value="{{ $lead->id }}" {{ $lead_id == $lead->id ? 'selected' : '' }}>{{ $lead->title }}</option>
                    @endforeach
                </x-admin::form.control-group.control>
            </x-admin::form.control-group>

            <div class="flex gap-4">
                <div class="flex-1">
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">Category</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="select" name="category" rules="required" label="Category">
                            <option value="functional">Functional</option>
                            <option value="non_functional">Non-Functional</option>
                            <option value="technical">Technical</option>
                            <option value="business">Business</option>
                            <option value="integration">Integration</option>
                        </x-admin::form.control-group.control>
                    </x-admin::form.control-group>
                </div>
                <div class="flex-1">
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">Priority</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="select" name="priority" rules="required" label="Priority">
                            <option value="must_have">Must Have</option>
                            <option value="should_have">Should Have</option>
                            <option value="nice_to_have">Nice to Have</option>
                        </x-admin::form.control-group.control>
                    </x-admin::form.control-group>
                </div>
            </div>

            <x-admin::form.control-group>
                <x-admin::form.control-group.label>Description</x-admin::form.control-group.label>
                <x-admin::form.control-group.control type="textarea" name="description" label="Description" placeholder="Requirement details..." />
                <x-admin::form.control-group.error control-name="description" />
            </x-admin::form.control-group>
        </div>
    </x-admin::form>
</x-admin::layouts>
