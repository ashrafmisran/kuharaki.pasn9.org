@if(isset($breadcrumbs) && count($breadcrumbs) > 1)
<nav class="flex mb-8" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        @foreach($breadcrumbs as $index => $breadcrumb)
            <li class="inline-flex items-center">
                @if($index === 0)
                    <a href="{{ $breadcrumb['url'] }}" class="text-gray-700 hover:text-blue-600 inline-flex items-center">
                        {!! $breadcrumb['icon'] ?? '' !!}
                        {{ $breadcrumb['title'] }}
                    </a>
                @elseif($index === count($breadcrumbs) - 1)
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-gray-500">{{ $breadcrumb['title'] }}</span>
                    </div>
                @else
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ $breadcrumb['url'] }}" class="ml-1 text-gray-700 hover:text-blue-600">
                            {{ $breadcrumb['title'] }}
                        </a>
                    </div>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
@endif