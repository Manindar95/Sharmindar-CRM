<x-admin::layouts>
    <x-slot:title>
        Requirements Gathering
    </x-slot>

    <div class="flex flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <div class="flex flex-col gap-2">
                <div class="text-xl font-bold dark:text-white">
                    IT Sales — Requirements Gathering
                </div>
            </div>

            <div class="flex items-center gap-x-2.5">
                <a href="{{ route('admin.it_sales.requirements.create') }}" class="primary-button">
                    Add Requirement
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
                            <th scope="col" class="px-6 py-3">Title</th>
                            <th scope="col" class="px-6 py-3">Category</th>
                            <th scope="col" class="px-6 py-3">Priority</th>
                            <th scope="col" class="px-6 py-3">Complexity</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requirements as $requirement)
                            <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">{{ $requirement->id }}</td>
                                <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ $requirement->title }}
                                </th>
                                <td class="px-6 py-4">{{ ucfirst(str_replace('_', ' ', $requirement->category)) }}</td>
                                <td class="px-6 py-4">
                                    <span class="rounded px-2 py-0.5 text-xs font-bold
                                        @if($requirement->priority == 'must_have') bg-red-100 text-red-800 @elseif($requirement->priority == 'should_have') bg-yellow-100 text-yellow-800 @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $requirement->priority)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ ucfirst(str_replace('_', ' ', $requirement->complexity)) }}</td>
                                <td class="px-6 py-4">{{ ucfirst($requirement->status) }}</td>
                            </tr>
                        @empty
                            <tr class="bg-white dark:bg-gray-800">
                                <td colspan="6" class="px-6 py-4 text-center">No requirements found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $requirements->links() }}
            </div>
        </div>
    </div>
</x-admin::layouts>
