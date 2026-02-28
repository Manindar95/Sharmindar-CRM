<x-admin::layouts>
    <x-slot:title>
        Create Designation
    </x-slot:title>

    <form method="POST" action="{{ route('company.core.department.designations.store') }}">
        @csrf

        <div class="flex gap-[16px] justify-between items-center max-sm:flex-wrap mb-4">
            <p class="text-[20px] text-gray-800 dark:text-white font-bold">
                Create Designation
            </p>

            <div class="flex gap-x-[10px] items-center">
                <a href="{{ route('company.core.department.designations.index') }}" class="transparent-button">
                    Cancel
                </a>

                <button type="submit" class="primary-button">
                    Save Designation
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
                            placeholder="Designation Name (e.g. Senior Developer)"
                        />
                        <x-admin::form.control-group.error control-name="name" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            Code
                        </x-admin::form.control-group.label>
                        <x-admin::form.control-group.control
                            type="text"
                            name="code"
                            :value="old('code')"
                            rules="required"
                            label="Code"
                            placeholder="Designation Code (e.g. SNR_DEV)"
                        />
                        <x-admin::form.control-group.error control-name="code" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Department
                        </x-admin::form.control-group.label>
                        <x-admin::form.control-group.control
                            type="select"
                            name="department_id"
                            label="Department"
                        >
                            <option value="">Select Department</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </x-admin::form.control-group.control>
                        <x-admin::form.control-group.error control-name="department_id" />
                    </x-admin::form.control-group>
                </div>
            </div>
        </div>
    </form>
</x-admin::layouts>
