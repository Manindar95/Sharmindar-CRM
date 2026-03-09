<x-admin::layouts>
    <x-slot:title>
        Designations
    </x-slot:title>

    <div class="flex gap-[16px] justify-between items-center max-sm:flex-wrap">
        <p class="text-[20px] text-gray-800 dark:text-white font-bold">
            Designations
        </p>

        <div class="flex gap-x-[10px] items-center">
            <a href="{{ route('company.core.department.designations.create') }}" class="primary-button">
                Create Designation
            </a>
        </div>
    </div>

    <div class="page-content mt-[20px]">
        <x-admin::datagrid
            :src="route('company.core.department.designations.index')"
            ref="datagrid"
        />
    </div>
</x-admin::layouts>
