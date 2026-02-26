<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.proposals.index.title')
    </x-slot>

    <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
        <p class="text-xl font-bold text-gray-800 dark:text-white">
            @lang('admin::app.proposals.index.title')
        </p>

        <div class="flex items-center gap-x-2.5">
            @if (acl()->getPermission('proposals.create'))
                <a
                    href="{{ route('admin.proposals.create') }}"
                    class="primary-button"
                >
                    @lang('admin::app.proposals.index.create-btn')
                </a>
            @endif
        </div>
    </div>

    <x-admin::datagrid :src="route('admin.proposals.index')" />
</x-admin::layouts>
