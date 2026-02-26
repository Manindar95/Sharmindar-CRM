<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.settings.audit-logs.index.title')
    </x-slot>

    <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
        <p class="text-xl font-bold text-gray-800 dark:text-white">
            @lang('admin::app.settings.audit-logs.index.title')
        </p>
    </div>

    <div class="mt-7">
        <x-admin::datagrid :src="route('admin.settings.audit_logs.index')" />
    </div>
</x-admin::layouts>
