@extends('layouts.main')

@section('contents')

    <div class="flex justify-center items-center w-full">
        <div class="flex flex-col items-center max-w-sm w-full bg-white bg-opacity-95 p-8 rounded-lg shadow-lg">
            <h1 class="font-semibold text-primary text-4xl mb-6 text-center" style="color: #593b1f;">Form Booking</h1>
            <form action="{{ route('submit.booking') }}" method="POST" onsubmit="return validateInput();" class="w-full">
            @csrf
                <input type="hidden" name="status" value="pending">
                <div class="input-box relative mb-4 w-full">
                    <i class='bx bx-store absolute left-3 top-1/2 transform -translate-y-1/2 text-[#593B1F] text-lg'></i>
                    <select id="coffee-shop-name" name="coffee_shop_name" class="w-full py-3 pl-10 border border-gray-300 rounded-lg focus:border-[#814E2B] focus:outline-none transition shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-custom-brown-600" required>
                        <option value="" disabled selected>Pilih Coffee Shop</option>
                        @foreach($coffeeShops as $shop)
                            <option value="{{ $shop->shop_name }}">{{ $shop->shop_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-box relative mb-4 w-full">
                    <i class='bx bx-user absolute left-3 top-1/2 transform -translate-y-1/2 text-[#593B1F] text-lg'></i>
                    <input type="text" id="name" name="name" class="w-full py-3 pl-10 border border-gray-300 rounded-lg focus:border-[#814E2B] focus:outline-none transition shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-custom-brown-600" placeholder="Nama" required>
                </div>
                <div class="input-box relative mb-4 w-full">
                    <i class='bx bx-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-[#593B1F] text-lg'></i>
                    <input type="text" id="contact" name="contact" class="w-full py-3 pl-10 border border-gray-300 rounded-lg focus:border-[#814E2B] focus:outline-none transition shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-custom-brown-600" placeholder="Email / No.Tlp" required>
                </div>

                <div class="row mb-4 flex justify-between">
                    <div class="col-md-6 w-full mr-1">
                        <label for="start_time" class="block mb-1">Jam Mulai</label>
                        <div class="flex">
                            <select id="start_hour" name="start_hour" class="w-1/2 border border-gray-300 rounded-lg py-2 px-2 mr-2 focus:border-[#814E2B] focus:outline-none shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-custom-brown-600">
                                <option value="">00</option>
                                <script>
                                    for (let i = 8; i <= 22; i++) {
                                        document.write(`<option value="${i}">${String(i).padStart(2, '0')}</option>`);
                                    }
                                </script>
                            </select>
                            <select id="start_minute" name="start_minute" class="w-1/2 border border-gray-300 rounded-lg py-2 px-2 focus:border-[#814E2B] focus:outline-none shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-custom-brown-600">
                                <option value="0">00</option>
                                <option value="30">30</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 w-full ml-1">
                        <label for="end_time" class="block mb-1">Jam Selesai</label>
                        <div class="flex">
                            <select id="end_hour" name="end_hour" class="w-1/2 border border-gray-300 rounded-lg py-2 px-2 mr-2 focus:border-[#814E2B] focus:outline-none shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-custom-brown-600">
                                <option value="">00</option>
                                <script>
                                    for (let i = 8; i <= 22; i++) {
                                        document.write(`<option value="${i}">${String(i).padStart(2, '0')}</option>`);
                                    }
                                </script>
                            </select>
                            <select id="end_minute" name="end_minute" class="w-1/2 border border-gray-300 rounded-lg py-2 px-2 focus:border-[#814E2B] focus:outline-none shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-custom-brown-600">
                                <option value="0">00</option>
                                <option value="30">30</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mb-4 flex">
                    <div class="col-md-6 w-full mr-1">
                        <label for="date" class="block mb-1">Hari</label>
                        <input type="date" id="date" name="date" class="w-full border border-gray-300 rounded-lg py-3 px-2 focus:border-[#814E2B] focus:outline-none shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-custom-brown-600" required>
                    </div>
                
                    <div class="col-md-6 w-full ml-1">
                        <label for="people" class="block mb-1">Jumlah Orang</label>
                        <div class="relative">
                            <i class='bx bx-user-plus absolute left-3 top-1/2 transform -translate-y-1/2 text-[#593B1F]'></i>
                            <input type="number" id="people" name="people" class="w-full border border-gray-300 rounded-lg py-3 pl-10 focus:border-[#814E2B] focus:outline-none shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-custom-brown-600" min="1" placeholder="Jumlah Orang" required>
                        </div>
                    </div>
                </div>

                <div class="input-box mb-4 w-full">
                    <label for="booking_type" class="block mb-1">Tipe Booking</label>
                    <select id="booking_type" name="booking_type" class="w-full border border-gray-300 rounded-lg py-3 px-2 focus:border-[#814E2B] focus:outline-none shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-custom-brown-600" required>
                        <option value="tempat">Booking Tempat (1 Coffee Shop)</option>
                        <option value="ruangan">Booking Ruangan (Meja + Kursi)</option>
                    </select>
                <div>
                    <button type="submit" style="background-color: #814e2b;" class="mt-4 flex w-full justify-center rounded-md px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-opacity-80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600 ">
                        Confirm Booking
                    </button>
                </div>
                </form>
        </div>
    </div>

@endsection