<x-admin::layouts>
    <x-slot:title>
        Multi-Stage Approvals
    </x-slot>

    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <div class="flex flex-col gap-2">
                <p class="text-xl font-bold dark:text-white">Pending Approvals</p>
            </div>
        </div>

        <div class="mt-3.5 overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">Module</th>
                        <th class="px-6 py-3">Type</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($approvals as $approval)
                        <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                            <td class="px-6 py-4">
                                @if($approval->approvable_type == 'Company\Core\ITSales\Models\Proposal') Proposal @else Requirement @endif
                            </td>
                            <td class="px-6 py-4">{{ ucfirst($approval->approval_type) }}</td>
                            <td class="px-6 py-4">
                                <span class="rounded px-2 py-0.5 text-xs font-bold @if($approval->status == 'approved') bg-green-100 text-green-800 @elseif($approval->status == 'rejected') bg-red-100 text-red-800 @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($approval->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $approval->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4">
                                @if($approval->status == 'pending')
                                    <form action="{{ route('admin.it_sales.approvals.approve', $approval->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:underline">Approve</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-4 text-center">No pending approvals found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin::layouts>
