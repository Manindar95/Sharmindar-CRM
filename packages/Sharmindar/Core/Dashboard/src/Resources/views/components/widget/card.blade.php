@props([
    'title' => '',
    'value' => '0',
    'icon'  => 'icon-settings',
    'color' => 'brandColor' // Tailwind class text color variable or literal
])

<div class="flex flex-col justify-between rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-800 dark:bg-gray-900 transition-all hover:shadow-md">
    <div class="flex items-center justify-between">
        <p class="text-sm font-semibold text-gray-500 dark:text-gray-400">
            {{ $title }}
        </p>
        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-{{ $color }}/10">
            <span class="{{ $icon }} text-xl text-{{ $color }}"></span>
        </div>
    </div>
    <div class="mt-4">
        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
            {{ $value }}
        </h3>
        
        <!-- Optional sub-text slot -->
        @if(isset($footer))
            <div class="mt-2 text-xs">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>
