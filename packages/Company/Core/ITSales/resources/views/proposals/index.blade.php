<x-admin::layouts>
    <x-slot:title>
        {{ __('it_sales::app.proposals.index.title') }}
    </x-slot>

    <div class="flex flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <div class="flex flex-col gap-2">
                <div class="text-xl font-bold dark:text-white">
                    {{ __('it_sales::app.proposals.index.title') }}
                </div>
            </div>

            <div class="flex items-center gap-x-2.5">
                <a href="{{ route('admin.it_sales.proposals.create') }}" class="primary-button">
                    Create Proposal
                </a>
            </div>
        </div>

        <!-- Content -->
        <div class="mt-3.5">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Number</th>
                            <th scope="col" class="px-6 py-3">Title</th>
                            <th scope="col" class="px-6 py-3">Lead</th>
                            <th scope="col" class="px-6 py-3">Amount</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($proposals as $proposal)
                            <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 font-bold">{{ $proposal->proposal_number }}</td>
                                <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ $proposal->title }}
                                </th>
                                <td class="px-6 py-4">@if($proposal->lead) <a href="{{ route('admin.leads.view', $proposal->lead_id) }}" class="text-blue-600 hover:underline">{{ $proposal->lead->title }}</a> @else - @endif</td>
                                <td class="px-6 py-4">{{ core()->formatBasePrice($proposal->total_amount) }}</td>
                                <td class="px-6 py-4">
                                    <span class="rounded px-2 py-1 text-xs font-semibold
                                        @if($proposal->status == 'draft') bg-gray-100 text-gray-800 @elseif($proposal->status == 'sent_to_client') bg-blue-100 text-blue-800 @elseif($proposal->status == 'accepted') bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $proposal->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.it_sales.proposals.edit', $proposal->id) }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white dark:bg-gray-800">
                                <td colspan="6" class="px-6 py-4 text-center">No proposals found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $proposals->links() }}
            </div>
        </div>
    </div>
</x-admin::layouts>
