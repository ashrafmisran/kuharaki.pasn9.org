@extends('layouts.app')

@section('title', 'Produk & Servis - Kuharaki')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Produk & Servis</h2>
        <p class="text-lg text-gray-600">Jelajahi pelbagai produk dan perkhidmatan yang ditawarkan</p>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
        <form method="GET" action="{{ route('produk-servis.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-3">Cari Produk/Servis</label>
                    <input type="text" 
                           id="search"
                           name="search"
                           value="{{ request('search') }}"
                           class="w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                           placeholder="Nama produk atau servis...">
                </div>
                <div>
                    <label for="industri" class="block text-sm font-medium text-gray-700 mb-3">Industri</label>
                    <select id="industri" name="industri" class="w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua Industri</option>
                        @foreach($industriList as $industri)
                            <option value="{{ $industri->id }}" {{ request('industri') == $industri->id ? 'selected' : '' }}>
                                {{ $industri->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="harga_min" class="block text-sm font-medium text-gray-700 mb-3">Harga Minimum</label>
                    <input type="number" 
                           id="harga_min"
                           name="harga_min"
                           value="{{ request('harga_min') }}"
                           step="0.01"
                           class="w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                           placeholder="0.00">
                </div>
                <div>
                    <label for="harga_max" class="block text-sm font-medium text-gray-700 mb-3">Harga Maksimum</label>
                    <input type="number" 
                           id="harga_max"
                           name="harga_max"
                           value="{{ request('harga_max') }}"
                           step="0.01"
                           class="w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                           placeholder="0.00">
                </div>
            </div>
            <div class="mt-6 flex justify-between items-center">
                <a href="{{ route('produk-servis.index') }}" class="text-gray-500 hover:text-gray-700">
                    Reset Penapis
                </a>
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 font-medium">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <!-- Statistics -->
    @if($produkServis->total() > 0)
        <div class="mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Jumlah Produk & Servis</h3>
                            <p class="text-2xl font-bold text-blue-600">{{ $produkServis->total() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m11 0a2 2 0 01-2 2H7a2 2 0 01-2-2m2 0V9a2 2 0 012-2h2a2 2 0 012 2v10"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Perniagaan Aktif</h3>
                            <p class="text-2xl font-bold text-green-600">{{ $produkServis->pluck('perniagaan_id')->unique()->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Halaman</h3>
                            <p class="text-2xl font-bold text-purple-600">{{ $produkServis->currentPage() }} dari {{ $produkServis->lastPage() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($produkServis->count() > 0)
        <!-- Results -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($produkServis as $item)
                @include('components.product-card', ['produkServis' => $item])
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $produkServis->appends(request()->query())->links() }}
        </div>
    @else
        @include('components.empty-state', [
            'title' => 'Tiada produk atau servis dijumpai',
            'description' => 'Cuba ubah kriteria carian anda atau reset penapis.',
            'actionText' => 'Reset Penapis',
            'actionUrl' => route('produk-servis.index')
        ])
    @endif
@endsection