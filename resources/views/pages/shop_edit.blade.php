@extends('layouts.main')

@section('contents')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">

    <h2 class="text-3xl font-bold mb-6 text-center">Edit Data Toko</h2>

    @if (session('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="p-4 mb-4 text-red-700 bg-red-100 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form class="space-y-6" action="{{ route('shop.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Shop Name -->
            <div>
                <label for="shop_name" class="block text-gray-700 font-medium mb-1">Nama Toko</label>
                <input type="text" name="shop_name" value="{{ old('shop_name', $coffeeShop->shop_name) }}" class="w-full border p-2 rounded focus:ring focus:ring-blue-300" required>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $coffeeShop->email) }}" class="w-full border p-2 rounded focus:ring focus:ring-blue-300" required>
            </div>

            <!-- Phone Number -->
            <div>
                <label for="phone_number" class="block text-gray-700 font-medium mb-1">Nomor Telepon</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $coffeeShop->phone_number) }}" class="w-full border p-2 rounded focus:ring focus:ring-blue-300" required>
            </div>

            <!-- Address -->
            <div>
                <label for="address" class="block text-gray-700 font-medium mb-1">Alamat</label>
                <input type="text" name="address" value="{{ old('address', $coffeeShop->address) }}" class="w-full border p-2 rounded focus:ring focus:ring-blue-300" required>
            </div>

            <!-- Category -->
            <div>
                <label for="category" class="block text-gray-700 font-medium mb-1">Kategori</label>
                <input type="text" name="category" value="{{ old('category', $coffeeShop->category) }}" class="w-full border p-2 rounded focus:ring focus:ring-blue-300" required>
            </div>

            <!-- Opening Hour -->
            <div>
                <label for="opening_hour" class="block text-gray-700 font-medium mb-1">Jam Buka</label>
                <input type="time" name="opening_hour" value="{{ old('opening_hour', $coffeeShop->opening_hour) }}" class="w-full border p-2 rounded focus:ring focus:ring-blue-300" required>
            </div>

            <!-- Closing Hour -->
            <div>
                <label for="closing_hour" class="block text-gray-700 font-medium mb-1">Jam Tutup</label>
                <input type="time" name="closing_hour" value="{{ old('closing_hour', $coffeeShop->closing_hour) }}" class="w-full border p-2 rounded focus:ring focus:ring-blue-300" required>
            </div>

            <!-- Open Days -->
            <div>
                <label for="open_days" class="block text-gray-700 font-medium mb-1">Hari Buka</label>
                <input type="text" name="open_days" value="{{ old('open_days', $coffeeShop->open_days) }}" class="w-full border p-2 rounded focus:ring focus:ring-blue-300" required>
            </div>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-gray-700 font-medium mb-1">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full border p-2 rounded focus:ring focus:ring-blue-300">{{ old('description', $coffeeShop->description) }}</textarea>
        </div>

        <!-- Profile Picture -->
        <div>
            <label for="profile_picture" class="block text-gray-700 font-medium mb-1">Foto Profil</label>
            <input type="file" name="profile_picture" class="w-full border p-2 rounded focus:ring focus:ring-blue-300">
            @if ($coffeeShop->profile_picture)
                <p class="mt-2">Gambar Saat Ini:</p>
                <img src="{{ asset('storage/' . $coffeeShop->profile_picture) }}" class="w-32 mt-2 rounded">
            @endif
        </div>

        <!-- Google Maps Link -->
        <div>
            <label for="google_maps_link" class="block text-gray-700 font-medium mb-1">Link Google Maps</label>
            <input type="url" name="google_maps_link" value="{{ old('google_maps_link', $coffeeShop->google_maps_link) }}" class="w-full border p-2 rounded focus:ring focus:ring-blue-300">
        </div>

        <!-- Submit Button -->
        <div class="text-center mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 focus:ring focus:ring-blue-300">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
