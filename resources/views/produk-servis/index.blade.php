@extends('layouts.app')

@section('title', 'Produk & Servis - Kuharaki')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Produk & Servis</h2>
        <p class="text-lg text-gray-600">Jelajahi pelbagai produk dan perkhidmatan yang ditawarkan</p>
    </div>

    {{-- Search --}}
    <div class="mb-8 bg-linear-to-r from-teal-200 to-emerald-500 rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-900">Cari Produk/Servis</h3>
        <div class="mt-2 text-gray-700">
            Gunakan borang di bawah untuk mencari produk atau servis yang anda perlukan.
        </div>
        <div class="mt-4">
            <form method="GET" action="{{ route('produk-servis.index') }}" class="flex flex-col sm:flex-row gap-4">
                <input type="text" 
                       name="search"
                       autofocus
                       value="{{ request('search') }}"
                       class="flex-1 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                       placeholder="Nama produk atau servis...">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 font-medium">
                    Cari
                </button>
            </form>
        </div>
    </div>

    {{-- Product/Service Listings --}}
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