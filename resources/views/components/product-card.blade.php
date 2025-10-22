@props(['produkServis'])

<div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200 overflow-hidden">
    @if($produkServis->first_image)
        <a href="{{ route('produk-servis.show', $produkServis->id) }}" class="block relative">
            <div class="aspect-w-16 aspect-h-9">
                <img src="{{ $produkServis->first_image }}" 
                     alt="{{ $produkServis->nama }}" 
                     class="w-full h-48 object-cover">
            </div>
            @php($imageCount = is_array($produkServis->images_urls ?? null) ? count($produkServis->images_urls) : 0)
            @if($imageCount > 0)
                <span class="absolute top-2 right-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-black/70 text-white">
                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7a2 2 0 012-2h3l2-2h4l2 2h3a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" />
                    </svg>
                    {{ $imageCount }}
                </span>
            @endif
        </a>
    @endif
    
    <div class="p-6">
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $produkServis->nama }}</h3>
            <p class="text-sm text-gray-600 line-clamp-3">{!! Str::limit($produkServis->deskripsi, 100) !!}</p>
        </div>
        
        @if($produkServis->industri)
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mb-3">
                {{ $produkServis->industri->nama }}
            </span>
        @endif
        
        <div class="border-t border-gray-100 pt-4">
            <div class="flex justify-between items-center mb-3">
                @if($produkServis->harga)
                    <span class="text-lg font-bold text-blue-600">
                        RM {{ number_format($produkServis->harga, 2) }}
                    </span>
                @else
                    <span class="text-sm text-gray-500">Harga tidak dinyatakan</span>
                @endif
            </div>
            
            @if($produkServis->perniagaan)
                <div class="flex items-center text-sm text-gray-500">
                    @if($produkServis->perniagaan->hasLogo())
                        <img src="{{ $produkServis->perniagaan->logo_url }}" alt="{{ $produkServis->perniagaan->nama }}" class="w-4 h-4 rounded mr-2 border border-gray-200 object-cover">
                    @else
                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m4 0v-4a1 1 0 011-1h4a1 1 0 011 1v4M7 7h10M7 10h10M7 13h10"></path>
                        </svg>
                    @endif
                    <a href="{{ route('perniagaan.show', $produkServis->perniagaan->id) }}" class="hover:text-blue-600 truncate">
                        {{ $produkServis->perniagaan->nama }}
                    </a>
                </div>
            @endif
        </div>
        
        <div class="mt-4">
            <a href="{{ route('produk-servis.show', $produkServis->id) }}" class="w-full bg-blue-600 text-white text-center py-2 px-4 rounded-md hover:bg-blue-700 transition-colors inline-block">
                Lihat Butiran
            </a>
        </div>
    </div>
</div>