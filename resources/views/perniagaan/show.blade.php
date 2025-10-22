@extends('layouts.app')

@section('title', $perniagaan->nama . ' - Kuharaki')

@section('content')
    <!-- Breadcrumb -->
    @include('components.breadcrumb', [
        'breadcrumbs' => [
            [
                'title' => 'Perniagaan',
                'url' => route('perniagaan.index'),
                'icon' => '<svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>'
            ],
            [
                'title' => $perniagaan->nama,
                'url' => '#'
            ]
        ]
    ])

    <!-- Business Details -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-8">
        <div class="p-8">
            <div class="flex items-start justify-between mb-6">
                <div class="flex items-start space-x-4 flex-1 gap-3">
                    <div class="flex-shrink-0">
                        <img src="{{ $perniagaan->logo_url }}" 
                             alt="{{ $perniagaan->nama }}" 
                             class="md:w-30 md:h-30 sm:w-15 sm:h-15 rounded-full object-cover border border-gray-200 shadow-sm">
                    </div>
                    <div class="flex-1 min-w-0 align-items-center">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $perniagaan->nama }}</h1>
                        <p class="text-lg text-gray-600 mb-4">{{ $perniagaan->deskripsi }}</p>
                    </div>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    @if($perniagaan->kategori === 'fizikal') bg-green-100 text-green-800
                    @elseif($perniagaan->kategori === 'atas talian') bg-blue-100 text-blue-800
                    @else bg-purple-100 text-purple-800
                    @endif">
                    {{ ucfirst($perniagaan->kategori) }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Contact Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Maklumat Hubungan</h3>
                    <div class="space-y-3">
                        @if($perniagaan->alamat)
                            <div class="flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-0.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-gray-900">{{ $perniagaan->alamat }}</p>
                                    @if($perniagaan->bandar)
                                        <p class="text-gray-500">{{ $perniagaan->bandar->nama }}@if($perniagaan->bandar->negeri), {{ $perniagaan->bandar->negeri->nama }}@endif</p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if($perniagaan->telefon)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <a href="tel:{{ $perniagaan->telefon }}" class="text-blue-600 hover:text-blue-800">{{ $perniagaan->telefon }}</a>
                            </div>
                        @endif

                        @if($perniagaan->emel)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <a href="mailto:{{ $perniagaan->emel }}" class="text-blue-600 hover:text-blue-800">{{ $perniagaan->emel }}</a>
                            </div>
                        @endif

                        @if($perniagaan->laman_web)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9c-5 0-9-4-9-9s4-9 9-9"></path>
                                </svg>
                                <a href="{{ $perniagaan->laman_web }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    {{ $perniagaan->laman_web }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Business Hours or Additional Info -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Maklumat Tambahan</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm font-medium text-gray-500">Kategori Perniagaan:</span>
                            <p class="text-gray-900">{{ ucfirst($perniagaan->kategori) }}</p>
                        </div>
                        @if($perniagaan->created_at)
                            <div>
                                <span class="text-sm font-medium text-gray-500">Didaftarkan:</span>
                                <p class="text-gray-900">{{ $perniagaan->created_at->format('d M Y') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products and Services -->
    @if($perniagaan->produkServis->count() > 0)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk & Servis</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($perniagaan->produkServis as $produkServis)
                        @include('components.product-card', ['produkServis' => $produkServis])
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection