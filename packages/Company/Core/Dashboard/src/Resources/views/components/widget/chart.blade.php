@props([
    'title' => '',
])

<div class="flex flex-col rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-800 dark:bg-gray-900 h-full min-h-[300px]">
    @if($title)
        <div class="mb-4 border-b pb-2 dark:border-gray-800">
            <h3 class="font-semibold text-gray-800 dark:text-white">{{ $title }}</h3>
        </div>
    @endif
    
    <div class="relative flex-grow w-full">
        <!-- The individual chart implementation (Chart.js / Vue) gets injected here -->
        {{ $slot }}
    </div>
</div>
