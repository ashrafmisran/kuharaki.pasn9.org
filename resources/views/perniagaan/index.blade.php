@extends('layouts.app')

@section('title', 'Senarai Perniagaan - Kuharaki')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Direktori Perniagaan</h2>
        <p class="text-lg text-gray-600">Temui perniagaan tempatan yang sesuai dengan keperluan anda</p>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
        <form method="GET" action="{{ route('perniagaan.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-3">Cari Perniagaan</label>
                    <input type="text" 
                           id="search"
                           name="search"
                           value="{{ request('search') }}"
                           class="w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                           placeholder="Nama perniagaan...">
                </div>
                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700 mb-3">Kategori</label>
                    <select id="kategori" name="kategori" class="w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua Kategori</option>
                        <option value="fizikal" {{ request('kategori') == 'fizikal' ? 'selected' : '' }}>Fizikal</option>
                        <option value="atas talian" {{ request('kategori') == 'atas talian' ? 'selected' : '' }}>Atas Talian</option>
                        <option value="hibrid" {{ request('kategori') == 'hibrid' ? 'selected' : '' }}>Hibrid</option>
                    </select>
                </div>
                <div>
                    <label for="negeri" class="block text-sm font-medium text-gray-700 mb-3">Negeri</label>
                    <select id="negeri" name="negeri" class="w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua Negeri</option>
                        @foreach(\App\Models\Negeri::all() as $negeri)
                            <option value="{{ $negeri->id }}" {{ request('negeri') == $negeri->id ? 'selected' : '' }}>
                                {{ $negeri->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-6 flex justify-between items-center">
                <a href="{{ route('perniagaan.index') }}" class="text-gray-500 hover:text-gray-700">
                    Reset Penapis
                </a>
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-md hover:bg-blue-700 transition-colors font-medium">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <!-- Business Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @forelse($perniagaan as $business)
            @include('components.business-card', ['business' => $business])
        @empty
            @include('components.empty-state', [
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m4 0v-4a1 1 0 011-1h4a1 1 0 011 1v4M7 7h10M7 10h10M7 13h10"></path>',
                'title' => 'Tiada perniagaan dijumpai',
                'description' => 'Cuba ubah kriteria carian anda.'
            ])
        @endforelse
    </div>

    <!-- Pagination -->
    @if($perniagaan->hasPages())
        <div class="flex justify-center">
            {{ $perniagaan->links() }}
        </div>
    @endif
@endsection