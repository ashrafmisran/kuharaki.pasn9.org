@extends('layouts.app')

@section('title', $produkServis->nama . ' - Kuharaki')

@section('content')
    <!-- Breadcrumb -->
    @include('components.breadcrumb', [
        'breadcrumbs' => [
            [
                'title' => 'Produk & Servis',
                'url' => route('produk-servis.index'),
                'icon' => '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>'
            ],
            [
                'title' => $produkServis->nama,
                'url' => '#'
            ]
        ]
    ])

    <!-- Product/Service Details -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-8">
        <div class="aspect-w-16 aspect-h-9">
            <img src="{{ $produkServis->featured_image_url }}" 
                 alt="{{ $produkServis->nama }}" 
                 class="w-full h-64 object-cover">
        </div>
        
        <div class="p-8">
                        <div class="flex items-start justify-between mb-6">
                            <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $produkServis->nama }}</h1>
                    <p class="text-lg text-gray-600 mb-4">{{ $produkServis->deskripsi }}</p>
                </div>
                @if($produkServis->harga)
                    <div class="text-right">
                        <span class="text-3xl font-bold text-blue-600">
                            RM {{ number_format($produkServis->harga, 2) }}
                        </span>
                    </div>
                @endif
            </div>

            

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Product/Service Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Maklumat Produk/Servis</h3>
                    <div class="space-y-4">
                        @if($produkServis->industri)
                            <div class="flex items-start">
                                <svg class="w-5 h-5 mr-4 mt-0.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m11 0a2 2 0 01-2 2H7a2 2 0 01-2-2m2 0V9a2 2 0 012-2h2a2 2 0 012 2v10"></path>
                                </svg>
                                <div>
                                    <span class="text-sm font-medium text-gray-500 block mb-1">Industri:</span>
                                    <p class="text-gray-900">{{ $produkServis->industri?->nama }}</p>
                                </div>
                            </div>
                        @endif

                        @if($produkServis->created_at)
                            <div class="flex items-start">
                                <svg class="w-5 h-5 mr-4 mt-0.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4M8 21h8a2 2 0 002-2V7a2 2 0 00-2-2H8a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <span class="text-sm font-medium text-gray-500 block mb-1">Didaftarkan:</span>
                                    <p class="text-gray-900">{{ $produkServis->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Business Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Perniagaan</h3>
                    <div class="bg-gray-50 rounded-lg p-8">
                        <div class="flex items-start justify-between mb-6">
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-900 mb-3">
                                    <a href="{{ route('perniagaan.show', $produkServis->perniagaan) }}" class="hover:text-blue-600">
                                        <span class="inline-flex items-center">
                                            @if($produkServis->perniagaan->logo_url)
                                                <img src="{{ $produkServis->perniagaan->logo_url }}" alt="{{ $produkServis->perniagaan->nama }}" class="w-6 h-6 rounded mr-2 border border-gray-200 object-cover">
                                            @endif
                                            {{ $produkServis->perniagaan->nama }}
                                        </span>
                                    </a>
                                </h4>
                                <p class="text-gray-600 mb-4">{{ $produkServis->perniagaan->deskripsi }}</p>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                @if($produkServis->perniagaan->kategori === 'fizikal') bg-green-100 text-green-800
                                @elseif($produkServis->perniagaan->kategori === 'atas talian') bg-blue-100 text-blue-800
                                @else bg-purple-100 text-purple-800
                                @endif">
                                {{ ucfirst($produkServis->perniagaan->kategori) }}
                            </span>
                        </div>

                        <div class="space-y-3 text-sm">
                            @if($produkServis->perniagaan->alamat)
                                <div class="flex items-start text-gray-600">
                                    <svg class="w-4 h-4 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ $produkServis->perniagaan->alamat }}</span>
                                </div>
                            @endif
                            
                            @if($produkServis->perniagaan->telefon)
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <a href="tel:{{ $produkServis->perniagaan->telefon }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $produkServis->perniagaan->telefon }}
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('perniagaan.show', $produkServis->perniagaan) }}" 
                               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Lihat Perniagaan
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Gallery -->
    @if($produkServis->hasAdditionalImages())
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-8">
            <div class="p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Galeri Imej</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($produkServis->images_urls as $imageUrl)
                        <div class="aspect-w-1 aspect-h-1">
                            <img src="{{ $imageUrl }}" 
                                 alt="{{ $produkServis->nama }}" 
                                 class="w-full h-40 object-cover rounded-lg border border-gray-200 hover:shadow-md transition-shadow cursor-pointer"
                                 onclick="openImageModal('{{ $imageUrl }}')">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Related Products/Services -->
    @if($relatedProdukServis && $relatedProdukServis->count() > 0)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk & Servis Berkaitan</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($relatedProdukServis as $item)
                        @include('components.product-card', ['produkServis' => $item])
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center hidden">
        <div class="max-w-4xl max-h-4xl mx-4">
            <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white text-2xl font-bold z-10 bg-black bg-opacity-50 rounded-full w-8 h-8 flex items-center justify-center">
                ×
            </button>
            <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
        </div>
    </div>

    <script>
        function openImageModal(imageUrl) {
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside the image
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Close modal with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
@endsection