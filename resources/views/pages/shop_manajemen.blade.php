@extends('layouts.main')

@section('contents')
<div class="container mx-auto mt-8 px-4">
    <!-- Informasi Coffee Shop -->
    <div class="bg-white shadow-lg rounded-lg p-6 max-w-6xl mx-auto mb-8">
        <div class="flex flex-col md:flex-row items-center md:space-x-8">
            <!-- Gambar Profil -->
            @if($coffeeShop->profile_picture)
                <img src="{{ asset('storage/' . $coffeeShop->profile_picture) }}" alt="Foto Profil" 
                    class="w-32 h-32 rounded-full border-4 border-gray-200 shadow-md mb-4 md:mb-0">
            @endif

            <!-- Informasi Utama -->
            <div class="flex-1">
                <h1 class="text-3xl font-bold text-gray-800">{{ $coffeeShop->shop_name }}</h1>
                <p class="text-gray-600"><strong>Email:</strong> {{ $coffeeShop->email }}</p>
                <p class="text-gray-600"><strong>Nomor Telepon:</strong> {{ $coffeeShop->phone_number }}</p>
                <p class="text-gray-600"><strong>Alamat:</strong> {{ $coffeeShop->address }}</p>
                <p class="text-gray-600"><strong>Kategori:</strong> {{ $coffeeShop->category }}</p>
            </div>
        </div>

        <hr class="my-6 border-gray-300">

        <!-- Detail Tambahan -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <p class="text-gray-700"><strong>Jam Operasional:</strong> {{ $coffeeShop->opening_hour }} - {{ $coffeeShop->closing_hour }}</p>
            <p class="text-gray-700"><strong>Hari Operasional:</strong> {{ $coffeeShop->open_days }}</p>
            <p class="text-gray-700"><strong>Deskripsi:</strong> {{ $coffeeShop->description }}</p>
            <p class="text-gray-700">
                <strong>Google Maps:</strong> 
                <a href="{{ $coffeeShop->google_maps_link }}" target="_blank" class="text-blue-500 hover:underline">Lihat di Peta</a>
            </p>
        </div>

        <!-- Edit Button -->
        <div class="mt-6 text-center">
            <a href="{{ route('shop.edit') }}" 
               class="inline-block bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition duration-300">
                Edit Data
            </a>
        </div>
    </div>

    <!-- Daftar Booking -->
    <div class="bg-white shadow-lg rounded-lg p-6 max-w-6xl mx-auto">
        <h2 class="text-2xl font-bold mb-4">Daftar Booking</h2>

        @if($bookings->isEmpty())
            <p class="text-gray-500">Tidak ada booking saat ini.</p>
        @else
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="border px-4 py-2 text-left">Nama Pemesan</th>
                        <th class="border px-4 py-2 text-left">Tanggal</th>
                        <th class="border px-4 py-2 text-left">Jam</th>
                        <th class="border px-4 py-2 text-left">Jumlah Orang</th>
                        <th class="border px-4 py-2 text-left">Tipe Booking</th>
                        <th class="border px-4 py-2 text-left">Status</th>
                        <th class="border px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="border px-4 py-2">{{ $booking->name }}</td>
                            <td class="border px-4 py-2">{{ $booking->date }}</td>
                            <td class="border px-4 py-2">{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                            <td class="border px-4 py-2">{{ $booking->people }}</td>
                            <td class="border px-4 py-2">{{ $booking->booking_type }}</td>
                            <td class="border px-4 py-2">
                                <span class="px-2 py-1 rounded-md text-white 
                                    {{ $booking->status == 'accept' ? 'bg-green-500' : 'bg-red-500' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <form action="{{ route('shop.updateBookingStatus', $booking->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="border rounded px-2 py-1">
                                        <option value="accept" {{ $booking->status == 'accept' ? 'selected' : '' }}>Accept</option>
                                        <option value="cancel" {{ $booking->status == 'cancel' ? 'selected' : '' }}>Cancel</option>
                                    </select>
                                    <button type="submit" class="ml-2 bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection
