<?php

namespace App\Http\Controllers;

use App\Models\Booking;

class CoffeeShopBookingController extends Controller
{
    public function index()
    {
        // Ambil booking yang hanya terkait dengan coffee shop yang dimiliki oleh pengguna
        $user = auth()->user();
        $bookings = Booking::where('coffee_shop_id', $user->coffee_shop_id)->get();

        return view('coffeeshop.booking.index', compact('bookings'));
    }
}
