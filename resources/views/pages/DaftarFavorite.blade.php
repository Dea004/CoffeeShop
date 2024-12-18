@extends('layouts.main_profil')

@section('content')
<div class="main--content transition-all duration-500 ease-in-out p-8">
    <div class="header--wrapper mb-1">
        <div class="header--title">
            <h2 class="text-3xl font-semibold">Daftar Favorite</h2>
        </div>
    </div>
    
    <!-- Favorite Table -->
    <table class="favorite-table w-full table-auto border-separate border-spacing-0 shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-5 py-3 text-left text-sm font-semibold text-gray-600">No</th>
                <th class="px-5 py-3 text-left text-sm font-semibold text-gray-600">Nama Cafe</th>
                <th class="px-5 py-3 text-left text-sm font-semibold text-gray-600">Email</th>
                <th class="px-5 py-3 text-left text-sm font-semibold text-gray-600">Phone Number</th>
                <th class="px-5 py-3 text-left text-sm font-semibold text-gray-600">Address</th>
                <th class="px-5 py-3 text-left text-sm font-semibold text-gray-600">Category</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($favorites as $index => $favorite)
                <tr class="border-b border-gray-200">
                    <td class="px-5 py-3 text-sm font-medium text-gray-800">{{ $index + 1 }}</td>
                    <td class="px-5 py-3 text-sm text-gray-800">{{ $favorite->coffeeShop->shop_name }}</td>
                    <td class="px-5 py-3 text-sm text-gray-800">{{ $favorite->coffeeShop->email }}</td>
                    <td class="px-5 py-3 text-sm text-gray-800">{{ $favorite->coffeeShop->phone_number }}</td>
                    <td class="px-5 py-3 text-sm text-gray-800">{{ $favorite->coffeeShop->address }}</td>
                    <td class="px-5 py-3 text-sm text-gray-800">{{ $favorite->coffeeShop->category }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
