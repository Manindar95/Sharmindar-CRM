<x-admin::layouts>
    <x-slot:title>
        {{ __('it_sales::app.services.title') }}
    </x-slot>

    <div class="flex flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <div class="flex flex-col gap-2">
                <div class="text-xl font-bold dark:text-white">
                    {{ __('it_sales::app.services.title') }}
                </div>
            </div>

            <div class="flex items-center gap-x-2.5">
                <a href="{{ route('admin.it_sales.services.create') }}" class="primary-button">
                    {{ __('it_sales::app.services.create-title') }}
                </a>
            </div>
        </div>

        <!-- Content -->
        <div class="mt-3.5">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">{{ __('it_sales::app.services.datagrid.name') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('it_sales::app.services.datagrid.category') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('it_sales::app.services.datagrid.billing_type') }}</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">{{ $service->id }}</td>
                                <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ $service->name }}
                                </th>
                                <td class="px-6 py-4">{{ ucfirst($service->category) }}</td>
                                <td class="px-6 py-4">{{ str_replace('_', ' ', ucfirst($service->billing_type)) }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.it_sales.services.edit', $service->id) }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white dark:bg-gray-800">
                                <td colspan="5" class="px-6 py-4 text-center">No services found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $services->links() }}
            </div>
        </div>
    </div>
</x-admin::layouts>
