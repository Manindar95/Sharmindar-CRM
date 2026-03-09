<x-admin::layouts>
    <x-slot:title>
        Lifecycle Statuses
    </x-slot>

    <div class="flex flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <div class="flex flex-col gap-2">
                <div class="text-xl font-bold dark:text-white">
                    IT Sales — Lead Lifecycle Statuses
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($statuses as $status)
                <div class="flex flex-col gap-2 rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex items-center justify-between">
                        <span class="rounded-full px-2 py-1 text-xs font-bold" style="background-color: {{ $status->color }}20; color: {{ $status->color }}">
                            {{ $status->code }}
                        </span>
                        <span class="text-xs text-gray-500">Order: {{ $status->sort_order }}</span>
                    </div>
                    <p class="text-lg font-semibold dark:text-white">{{ $status->name }}</p>
                    <div class="mt-2 flex gap-2">
                        @if($status->is_terminal)
                            <span class="rounded bg-red-100 px-2 py-0.5 text-xs text-red-800">Terminal</span>
                        @endif
                        @if($status->is_active)
                            <span class="rounded bg-green-100 px-2 py-0.5 text-xs text-green-800">Active</span>
                        @else
                            <span class="rounded bg-gray-100 px-2 py-0.5 text-xs text-gray-800">Inactive</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-admin::layouts>
