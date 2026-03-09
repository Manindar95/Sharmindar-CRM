<x-admin::layouts>
    <!-- Page Title -->
    <x-slot:title>
        Audit Trails
    </x-slot>

    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <div class="flex flex-col gap-2">
                <div class="text-xl font-bold dark:text-white">
                    <!-- title -->
                    Audit Trails
                </div>
                <p class="text-gray-600 dark:text-gray-400">View model data creation, update, and deletion history.</p>
            </div>
        </div>

        <x-admin::datagrid :src="route('company.core.activity.audit_trails.index')">
            <!-- DataGrid Shimmer -->
            <x-admin::shimmer.datagrid />
        </x-admin::datagrid>
    </div>
</x-admin::layouts>
