<x-admin::layouts>
    <x-slot:title>
        Edit Requirement
    </x-slot>

    <x-admin::form :action="route('admin.it_sales.requirements.update', $requirement->id)" method="PUT">
        <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <div class="flex flex-col gap-2">
                <p class="text-xl font-bold dark:text-white">Edit Requirement</p>
            </div>
            <div class="flex items-center gap-x-2.5">
                <button type="submit" class="primary-button">Update Requirement</button>
            </div>
        </div>

        <div class="mt-3.5 rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
            <x-admin::form.control-group>
                <x-admin::form.control-group.label class="required">Title</x-admin::form.control-group.label>
                <x-admin::form.control-group.control type="text" name="title" value="{{ old('title') ?? $requirement->title }}" rules="required" label="Title" />
                <x-admin::form.control-group.error control-name="title" />
            </x-admin::form.control-group>

            <x-admin::form.control-group>
                <x-admin::form.control-group.label class="required">Category</x-admin::form.control-group.label>
                <x-admin::form.control-group.control type="select" name="category" rules="required" label="Category">
                    <option value="functional" {{ $requirement->category == 'functional' ? 'selected' : '' }}>Functional</option>
                    <option value="non_functional" {{ $requirement->category == 'non_functional' ? 'selected' : '' }}>Non-Functional</option>
                    <option value="technical" {{ $requirement->category == 'technical' ? 'selected' : '' }}>Technical</option>
                    <option value="business" {{ $requirement->category == 'business' ? 'selected' : '' }}>Business</option>
                    <option value="integration" {{ $requirement->category == 'integration' ? 'selected' : '' }}>Integration</option>
                </x-admin::form.control-group.control>
            </x-admin::form.control-group>

            <x-admin::form.control-group>
                <x-admin::form.control-group.label>Description</x-admin::form.control-group.label>
                <x-admin::form.control-group.control type="textarea" name="description" value="{{ old('description') ?? $requirement->description }}" label="Description" />
            </x-admin::form.control-group>
        </div>
    </x-admin::form>
</x-admin::layouts>
