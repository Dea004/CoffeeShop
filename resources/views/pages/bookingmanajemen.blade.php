@extends('layouts.main_profil')

@section('content')
    <div class="flex">
    <!-- main content -->
        <div class="main--content transition-all duration-500 ease-in-out p-8 bg-[#fef8f4]">
            <div class="header--wrapper mb-4">
                <div class="header--title">
                    <h2 class="text-3xl font-semibold text-[#333] mb-4">Manajemen Booking</h2>
                </div>
            </div>

        <!-- Booking Table -->
        <div class="bg-white shadow-lg rounded-lg border border-gray-300 flex flex-col">
    <!-- Header Tabel -->
    <table class="w-full table-fixed text-left border-collapse">
        <!-- Header -->
        <thead class="bg-[#814e2b] text-white">
            <tr>
                <th class="w-1/12 px-4 py-3 uppercase font-medium text-sm text-center">No</th>
                <th class="w-4/12 px-4 py-3 uppercase font-medium text-sm">Nama Cafe</th>
                <th class="w-4/12 px-4 py-3 uppercase font-medium text-sm">Tanggal Booking</th>
                <th class="w-3/12 px-4 py-3 uppercase font-medium text-sm text-center">Status</th>
            </tr>
        </thead>
        <!-- Body -->
        <tbody class="divide-y divide-gray-200 text-gray-700">
            @forelse($bookings as $index => $booking)
                <tr class="hover:bg-gray-100 transition-all">
                    <td class="px-4 py-4 text-center">{{ $index + 1 }}</td>
                    <td class="px-4 py-4">{{ $booking->coffee_shop_name }}</td>
                    <td class="px-4 py-4">{{ \Carbon\Carbon::parse($booking->date)->format('d-m-Y') }}</td>
                    <td class="px-4 py-4 text-center">
                        @if($booking->status == 'pending')
                            <span class="inline-block px-3 py-1 text-sm font-semibold bg-yellow-100 text-yellow-700 rounded-full">Pending</span>
                        @elseif($booking->status == 'accept')
                            <span class="inline-block px-3 py-1 text-sm font-semibold bg-green-100 text-green-700 rounded-full">Confirmed</span>
                        @elseif($booking->status == 'cancel')
                            <span class="inline-block px-3 py-1 text-sm font-semibold bg-red-100 text-red-700 rounded-full">Canceled</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-4 text-center text-gray-500 h-24">
                        Tidak ada booking yang ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

    </div>
        </div>
        </div>
    </div>
@endsection
