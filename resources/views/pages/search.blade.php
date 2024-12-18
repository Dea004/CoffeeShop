@extends('layouts.main')

@section('contents')
<div class="container mx-auto mt-12">
    <h1 class="text-center text-3xl font-poppins mb-4">Cari Coffee Shop</h1>

    <!-- Search Form -->
    <form class="mt-4" action="{{ route('search.submit') }}" method="POST">
        @csrf
        <div class="flex justify-center">
            <input
                type="text"
                class="form-control w-1/2 border border-gray-300 rounded-l-md py-2 px-4"
                placeholder="Cari Coffee Shop..."
                name="searchQuery"
                value="{{ old('searchQuery', $searchQuery ?? '') }}"
            />
            <button type="submit" class="bg-blue-500 text-white rounded-r-md px-4 py-2 flex items-center">
                <i class="bx bx-search search-icon"></i>
            </button>
        </div>
    </form>

    <!-- Hasil Pencarian -->
    @if(isset($results))
        <div class="mt-8">
            @if($results->isEmpty())
                <p class="text-center text-gray-600">Tidak ada hasil yang ditemukan untuk "{{ $searchQuery }}".</p>
            @else
                <h2 class="text-center text-2xl font-semibold mb-4">Hasil Pencarian:</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($results as $shop)
                <div class="bg-white shadow-lg rounded-lg p-4 flex flex-col h-full">
                    <div class="flex-grow">
                        <h3 class="font-semibold text-lg mb-2">{{ $shop->shop_name }}</h3>
                        <p class="text-gray-600">{{ $shop->address }}</p>
                        <p class="text-gray-500 text-sm">Kategori: {{ $shop->category }}</p>
                        <p class="text-gray-500 text-sm">Jam Buka: {{ $shop->opening_hour }} - {{ $shop->closing_hour }}</p>
                    </div>
                    <div class="flex justify-between gap-2 mt-4">
                        <a href="{{ route('coffeeShop.detail', $shop->id_shop) }}" 
                        class="bg-yellow-600 hover:bg-yellow-500 text-white text-center py-2 px-4 rounded w-full">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
            @endif
        </div>
    @endif
</div>
@endsection
