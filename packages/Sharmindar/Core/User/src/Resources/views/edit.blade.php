<x-admin::layouts>
    <x-slot:title>
        Edit Employee
    </x-slot>

    <x-admin::form
        :action="route('company.core.user.employees.update', $employee->id)"
        enctype="multipart/form-data"
        method="POST"
    >
        <div class="flex flex-col gap-4">
            <!-- Header -->
            <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                <div class="flex flex-col gap-2">
                    <div class="text-xl font-bold dark:text-white">
                        Edit Employee
                    </div>
                </div>

                <div class="flex items-center gap-x-2.5">
                    <a href="{{ route('company.core.user.employees.index') }}" class="transparent-button hover:bg-gray-200 dark:hover:bg-gray-800">
                        Cancel
                    </a>

                    <button type="submit" class="primary-button">
                        Update Employee
                    </button>
                </div>
            </div>

            <!-- Content -->
            <div class="box-shadow rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
                <div class="grid grid-cols-2 gap-4">
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">Name</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="text" name="name" value="{{ old('name') ?: $employee->name }}" rules="required" label="Name" />
                        <x-admin::form.control-group.error control-name="name" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">Email</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="email" name="email" value="{{ old('email') ?: $employee->email }}" rules="required|email" label="Email" />
                        <x-admin::form.control-group.error control-name="email" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>Password (Leave blank to keep current)</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="password" name="password" rules="min:6" label="Password" />
                        <x-admin::form.control-group.error control-name="password" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">Job Title</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="text" name="job_title" value="{{ old('job_title') ?: ($employee->employee_profile->job_title ?? '') }}" rules="required" label="Job Title" />
                        <x-admin::form.control-group.error control-name="job_title" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">Joining Date</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="date" name="joining_date" value="{{ old('joining_date') ?: ($employee->employee_profile->joining_date ?? '') }}" rules="required" label="Joining Date" />
                        <x-admin::form.control-group.error control-name="joining_date" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">Salary Type</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="select" name="salary_type" value="{{ old('salary_type') ?: ($employee->employee_profile->salary_type ?? 'monthly') }}" rules="required">
                            <option value="hourly">Hourly</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                        </x-admin::form.control-group.control>
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">Salary Amount</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="text" name="salary_amount" value="{{ old('salary_amount') ?: ($employee->employee_profile->salary_amount ?? '') }}" rules="required|decimal" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>Department</x-admin::form.control-group.label>
                        <v-department-select>
                            <input type="text" name="department_name" list="departments-list" class="control w-full rounded-md border border-gray-200 px-3 py-2 text-sm text-gray-600 transition-all hover:border-gray-400 focus:border-brand-color focus:ring-brand-color dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-gray-400" placeholder="Select or type to create new..." value="{{ old('department_name') ?: ($employee->employee_profile->department->name ?? '') }}" />
                        </v-department-select>
                        <datalist id="departments-list">
                            @foreach ($departments as $department)
                                <option value="{{ $department->name }}">{{ $department->name }}</option>
                            @endforeach
                        </datalist>
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>Reporting Manager</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="select" name="reporting_manager_id" value="{{ old('reporting_manager_id') ?: ($employee->employee_profile->reporting_manager_id ?? '') }}">
                            <option value="">Select Manager</option>
                            @foreach ($managers as $manager)
                                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                            @endforeach
                        </x-admin::form.control-group.control>
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>Status</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="switch" name="status" value="1" :checked="$employee->status" />
                    </x-admin::form.control-group>
                </div>

                <x-admin::form.control-group>
                    <x-admin::form.control-group.label>Skills (Comma separated)</x-admin::form.control-group.label>
                    <x-admin::form.control-group.control type="text" name="skills" value="{{ old('skills') ?: ($employee->employee_profile->skills ?? '') }}" />
                </x-admin::form.control-group>

                <div class="grid grid-cols-2 gap-4">
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>Experience (Years)</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="text" name="experience_years" value="{{ old('experience_years') ?: ($employee->employee_profile->experience_years ?? '') }}" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>Contact Number</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="text" name="contact_number" value="{{ old('contact_number') ?: ($employee->employee_profile->contact_number ?? '') }}" />
                    </x-admin::form.control-group>
                </div>

                <x-admin::form.control-group>
                    <x-admin::form.control-group.label>Address</x-admin::form.control-group.label>
                    <x-admin::form.control-group.control type="textarea" name="address" value="{{ old('address') ?: ($employee->employee_profile->address ?? '') }}" />
                </x-admin::form.control-group>
                
                <x-admin::form.control-group>
                    <x-admin::form.control-group.label>Avatar</x-admin::form.control-group.label>
                    @if($employee->image)
                        <div class="mb-2">
                            <img src="{{ Storage::url($employee->image) }}" class="h-16 w-16 rounded-full object-cover">
                        </div>
                    @endif
                    <x-admin::form.control-group.control type="file" name="image" />
                </x-admin::form.control-group>
                
                <input type="hidden" name="role_id" value="{{ $employee->role_id ?? 1 }}">
            </div>
        </div>
    </x-admin::form>

    @pushOnce('scripts')
        <script type="text/x-template" id="v-department-select-template">
             <div class="relative w-full">
                <input 
                    type="text" 
                    class="control w-full rounded-md border border-gray-200 px-3 py-2 text-sm text-gray-600 transition-all hover:border-gray-400 focus:border-brand-color focus:ring-brand-color dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-gray-400"
                    placeholder="Select or type to create new..."
                    v-model="searchQuery"
                    name="department_name"
                    @focus="isOpen = true"
                    @input="isOpen = true"
                    @blur="closeDropdown"
                    @keyup.enter.prevent="selectOrCreate(searchQuery)"
                    autocomplete="off"
                />
                <ul 
                    v-show="isOpen" 
                    class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md border border-gray-200 bg-white py-1 text-base shadow-lg focus:outline-none dark:border-gray-800 dark:bg-gray-900 sm:text-sm"
                >
                    <li 
                        v-for="option in filteredOptions" 
                        :key="option"
                        @mousedown.prevent="selectOrCreate(option)"
                        class="relative cursor-pointer select-none py-2 pl-3 pr-9 text-gray-900 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800"
                    >
                        @{{ option }}
                    </li>
                    <li 
                        v-if="searchQuery && !filteredOptions.includes(searchQuery)"
                        @mousedown.prevent="selectOrCreate(searchQuery)"
                        class="relative cursor-pointer select-none py-2 pl-3 pr-9 font-semibold text-brand-color hover:bg-gray-100 dark:hover:bg-gray-800"
                    >
                        Click here to add "@{{ searchQuery }}"
                    </li>
                </ul>
            </div>
        </script>

        <script type="module">
            app.component('v-department-select', {
                template: '#v-department-select-template',
                data() {
                    return {
                        isOpen: false,
                        searchQuery: "{{ old('department_name') ?: ($employee->employee_profile->department->name ?? '') }}",
                        options: [
                            @foreach ($departments as $department)
                                "{{ $department->name }}",
                            @endforeach
                        ]
                    }
                },
                computed: {
                    filteredOptions() {
                        if (!this.searchQuery) return this.options;
                        return this.options.filter(opt => opt.toLowerCase().includes(this.searchQuery.toLowerCase()));
                    }
                },
                methods: {
                    closeDropdown() {
                        setTimeout(() => {
                            this.isOpen = false;
                        }, 150);
                    },
                    selectOrCreate(val) {
                        this.searchQuery = val;
                        this.isOpen = false;
                    }
                }
            });
        </script>
    @endPushOnce
</x-admin::layouts>
