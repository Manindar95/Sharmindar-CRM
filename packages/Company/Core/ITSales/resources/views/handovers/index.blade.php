<x-admin::layouts>
    <x-slot:title>
        Project Handovers
    </x-slot>

    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <div class="flex flex-col gap-2">
                <p class="text-xl font-bold dark:text-white">Project Handovers (Sales to Ops)</p>
            </div>
            <div class="flex items-center gap-x-2.5">
                <a href="{{ route('admin.it_sales.handovers.create') }}" class="primary-button">New Handover</a>
            </div>
        </div>

        <div class="mt-3.5 overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">Lead</th>
                        <th class="px-6 py-3">Proposal</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($handovers as $handover)
                        <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                            <td class="px-6 py-4">{{ $handover->lead->title }}</td>
                            <td class="px-6 py-4">{{ $handover->proposal->proposal_number }}</td>
                            <td class="px-6 py-4">
                                <span class="rounded px-2 py-0.5 text-xs font-bold @if($handover->handover_status == 'completed') bg-green-100 text-green-800 @else bg-yellow-100 text-yellow-800 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $handover->handover_status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $handover->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.it_sales.handovers.show', $handover->id) }}" class="text-blue-600 hover:underline">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-4 text-center">No handovers found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin::layouts>
