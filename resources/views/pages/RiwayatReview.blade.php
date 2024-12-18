@extends('layouts.main_profil')

@section('content')
<div class="main--content transition-all duration-500 ease-in-out p-8">
    <div class="header--wrapper mb-1">
        <div class="header--title">
            <h2 class="text-3xl font-semibold">Riwayat Review</h2> 
        </div>
    </div>

    <!-- Tabel Riwayat Review -->
    <table class="review-table w-full table-auto border-separate border-spacing-0 shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-5 py-3 text-left text-sm font-semibold text-gray-600">No</th>
                <th class="px-5 py-3 text-left text-sm font-semibold text-gray-600">Nama Cafe</th>
                <th class="px-5 py-3 text-left text-sm font-semibold text-gray-600">Ulasan</th>
                <th class="px-5 py-3 text-left text-sm font-semibold text-gray-600">Rating</th>
                <th class="px-5 py-3 text-left text-sm font-semibold text-gray-600">Tanggal Rating</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reviews as $review)
                <tr class="border-b border-gray-200">
                    <td class="px-5 py-3 text-sm font-medium text-gray-800">{{ $loop->iteration }}</td>
                    <td class="px-5 py-3 text-sm text-gray-800">{{ $review->nama_cafe }}</td>
                    <td class="px-5 py-3 text-sm text-gray-800">{{ $review->ulasan }}</td>
                    <td class="px-5 py-3 text-sm text-gray-800">{{ $review->rating }}</td>
                    <td class="px-5 py-3 text-sm text-gray-800">{{ $review->tanggal_ulasan->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-5 py-3 text-sm text-center text-gray-500">Belum ada review</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
