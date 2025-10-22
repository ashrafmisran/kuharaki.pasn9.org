@props([
    'icon' => null,
    'title' => '',
    'description' => '',
    'actionText' => null,
    'actionUrl' => null,
])

<div class="col-span-full text-center py-12">
    @if ($icon)
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            {!! $icon !!}
        </svg>
    @else
        <!-- Fallback icon -->
        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-6 4h6M7 7h10a2 2 0 012 2v8a2 2 0 01-2 2H7a2 2 0 01-2-2V9a2 2 0 012-2zm3-4h4a2 2 0 012 2v2H8V5a2 2 0 012-2z" />
        </svg>
    @endif

    @if ($title)
        <h3 class="mt-4 text-base font-semibold text-gray-900">{{ $title }}</h3>
    @endif
    @if ($description)
        <p class="mt-1 text-sm text-gray-500">{{ $description }}</p>
    @endif

    @if ($actionText && $actionUrl)
        <div class="mt-6">
            <a href="{{ $actionUrl }}" class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                {{ $actionText }}
            </a>
        </div>
    @endif
</div>