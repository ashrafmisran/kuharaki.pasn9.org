@props(['business'])

<div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
    <div class="p-6">
        <div class="flex items-start justify-between flex-col-reverse mb-4">
            <div class="flex items-start space-x-3 flex-1 gap-3">
                <div class="grid flex-shrink-0 gap-1">
                    <img src="{{ $business->logo_url }}"
                         alt="{{ $business->nama }}"
                         class="w-25 h-25 rounded-full object-cover border border-gray-200">
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="text-lg font-semibold text-gray-900 mb-0">{{ $business->nama }}</h3>
                    <p class="text-sm text-gray-600 mb-3">{{ $business->bandar->nama }}</p>
                </div>
            </div>
            <div class="mb-2 justify-self-end grid inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                @if($business->kategori === 'fizikal') bg-green-100 text-green-800
                @elseif($business->kategori === 'atas talian') bg-blue-100 text-blue-800
                @else bg-purple-100 text-purple-800
                @endif">
                {{ ucfirst($business->kategori) }}
            </div>
        </div>

        <div class="space-y-2 mb-4">
            @if($business->alamat)
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="truncate">{{ $business->alamat }}</span>
                </div>
            @endif

            @if($business->bandar)
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m4 0v-4a1 1 0 011-1h4a1 1 0 011 1v4M7 7h10M7 10h10M7 13h10"></path>
                    </svg>
                    {{ $business->bandar->nama }}@if($business->bandar->negeri), {{ $business->bandar->negeri->nama }}@endif
                </div>
            @endif

            @if($business->telefon)
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <a href="tel:{{ $business->telefon }}" class="hover:text-blue-600">{{ $business->telefon }}</a>
                </div>
            @endif

            @if($business->emel)
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <a href="mailto:{{ $business->emel }}" class="hover:text-blue-600 truncate">{{ $business->emel }}</a>
                </div>
            @endif

            @if($business->laman_web)
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9c-5 0-9-4-9-9s4-9 9-9"></path>
                    </svg>
                    <a href="{{ $business->laman_web }}" target="_blank" class="text-blue-600 hover:text-blue-800 truncate">
                        {{ $business->laman_web }}
                    </a>
                </div>
            @endif
        </div>

        <div class="flex justify-between items-center pt-4 border-t border-gray-100">
            <a href="{{ route('perniagaan.show', $business->id) }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                Lihat Butiran
            </a>
            @if($business->produkServis->count() > 0)
                <span class="text-xs text-gray-500">
                    {{ $business->produkServis->count() }} produk/servis
                </span>
            @endif
        </div>
    </div>
</div>