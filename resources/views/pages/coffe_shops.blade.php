@extends('layouts.main')

@section('contents')

<h1 class="font-semibold text-center w-full text-4xl text-gray-800 mb-12">Rekomendasi Coffee Shop</h1>
<div class="max-w-screen-lg mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mx-auto max-w-screen-lg">
        @foreach($coffeeShops as $coffeeShop)
            <div class="bg-white border border-gray-300 rounded-lg shadow-lg p-4 flex flex-col h-96 transition-transform transform hover:scale-105 w-80">
                <!-- Gambar profil coffee shop -->
                @if($coffeeShop->profile_picture)
                    <img src="{{ asset('storage/' . $coffeeShop->profile_picture) }}" alt="{{ $coffeeShop->shop_name }}" class="w-full h-48 object-cover rounded-lg">
                @else
                    <img src="path/to/default-image.jpg" alt="Default Image" class="w-full h-48 object-cover rounded-lg">
                @endif

                <!-- Konten Card -->
                <div class="flex-grow mt-2">
                    <h2 class="font-semibold text-xl text-gray-700">{{ $coffeeShop->shop_name }}</h2>
                    <p class="text-gray-600 text-sm min-h-12 overflow-hidden">{{ $coffeeShop->description }}</p>
                    <p class="text-gray-600">Setiap Hari: {{ $coffeeShop->opening_hour }} - {{ $coffeeShop->closing_hour }}</p>
                </div>

                <!-- Tombol -->
                <div class="mt-auto flex justify-center">
                    <a href="{{ route('coffeeShop.detail', $coffeeShop->id_shop) }}" 
                       class="bg-yellow-600 text-white py-2 px-4 rounded w-full text-center">
                        Lihat Detail
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
