<x-admin::layouts>
    <x-slot:title>
        Create Department
    </x-slot:title>

    <form method="POST" action="{{ route('company.core.department.store') }}">
        @csrf

        <div class="flex gap-[16px] justify-between items-center max-sm:flex-wrap mb-4">
            <p class="text-[20px] text-gray-800 dark:text-white font-bold">
                Create Department
            </p>

            <div class="flex gap-x-[10px] items-center">
                <a href="{{ route('company.core.department.index') }}" class="transparent-button">
                    Cancel
                </a>

                <button type="submit" class="primary-button">
                    Save Department
                </button>
            </div>
        </div>

        <div class="flex gap-[10px] mt-[14px]">
            <div class="flex flex-col gap-[8px] flex-1">
                <div class="p-[16px] bg-white dark:bg-gray-900 rounded-[4px] box-shadow">
                    <p class="text-[16px] text-gray-800 dark:text-white font-semibold mb-[16px]">
                        General Information
                    </p>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            Name
                        </x-admin::form.control-group.label>
                        <x-admin::form.control-group.control
                            type="text"
                            name="name"
                            :value="old('name')"
                            rules="required"
                            label="Name"
                            placeholder="Department Name"
                        />
                        <x-admin::form.control-group.error control-name="name" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Code
                        </x-admin::form.control-group.label>
                        <x-admin::form.control-group.control
                            type="text"
                            name="code"
                            :value="old('code')"
                            label="Code"
                            placeholder="Department Code (e.g., sales, hr)"
                        />
                        <x-admin::form.control-group.error control-name="code" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Manager
                        </x-admin::form.control-group.label>
                        <x-admin::form.control-group.control
                            type="select"
                            name="manager_id"
                            label="Manager"
                        >
                            <option value="">Select Manager</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('manager_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </x-admin::form.control-group.control>
                        <x-admin::form.control-group.error control-name="manager_id" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Parent Department
                        </x-admin::form.control-group.label>
                        <x-admin::form.control-group.control
                            type="select"
                            name="parent_id"
                            label="Parent Department"
                        >
                            <option value="">None (Top Level)</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('parent_id') == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </x-admin::form.control-group.control>
                        <x-admin::form.control-group.error control-name="parent_id" />
                    </x-admin::form.control-group>
                </div>
            </div>
        </div>
    </form>
</x-admin::layouts>
