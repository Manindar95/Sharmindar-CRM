<x-admin::layouts>
    <x-slot:title>
        Employee Management
    </x-slot>

    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <div class="flex flex-col gap-2">
                <div class="text-xl font-bold dark:text-white">
                    Employee Management
                </div>
            </div>

            <div class="flex items-center gap-x-2.5">
                <a href="{{ route('company.core.user.employees.create') }}" class="primary-button">
                    Create Employee
                </a>
            </div>
        </div>

        <x-admin::datagrid
            :src="route('company.core.user.employees.index')"
            ref="datagrid"
        />
    </div>


</x-admin::layouts>
