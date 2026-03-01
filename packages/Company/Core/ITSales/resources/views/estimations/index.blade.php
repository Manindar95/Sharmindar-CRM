<x-admin::layouts>
    <x-slot:title>
        Technical Estimations
    </x-slot>

    <div class="flex flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <div class="flex flex-col gap-2">
                <div class="text-xl font-bold dark:text-white">
                    IT Sales — Technical Estimations
                </div>
            </div>

            <div class="flex items-center gap-x-2.5">
                <a href="{{ route('admin.it_sales.estimations.create') }}" class="primary-button">
                    Create Estimation
                </a>
            </div>
        </div>

        <!-- Content -->
        <div class="mt-3.5">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Proposal</th>
                            <th scope="col" class="px-6 py-3">Total Hours</th>
                            <th scope="col" class="px-6 py-3">Buffer</th>
                            <th scope="col" class="px-6 py-3">Grand Total</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($estimations as $estimation)
                            <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">@if($estimation->proposal) {{ $estimation->proposal->proposal_number }} @else - @endif</td>
                                <td class="px-6 py-4">{{ $estimation->total_hours }} hrs</td>
                                <td class="px-6 py-4">{{ $estimation->buffer_percentage }}%</td>
                                <td class="px-6 py-4 font-bold">{{ $estimation->grand_total_hours }} hrs</td>
                                <td class="px-6 py-4">
                                    <span class="rounded px-2 py-0.5 text-xs font-bold
                                        @if($estimation->status == 'approved') bg-green-100 text-green-800 @elseif($estimation->status == 'reviewed') bg-blue-100 text-blue-800 @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($estimation->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.it_sales.estimations.edit', $estimation->id) }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white dark:bg-gray-800">
                                <td colspan="6" class="px-6 py-4 text-center">No estimations found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $estimations->links() }}
            </div>
        </div>
    </div>
</x-admin::layouts>
