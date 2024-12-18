<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\CoffeeShop;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'coffee_shop_name' => 'required|string',
            'name' => 'required|string',
            'contact' => 'required|string',
            'start_hour' => 'required|integer',
            'start_minute' => 'required|integer',
            'end_hour' => 'required|integer',
            'end_minute' => 'required|integer',
            'date' => 'required|date',
            'people' => 'required|integer|min:1',
            'booking_type' => 'required|in:tempat,ruangan',
            'status' => 'required|in:pending,cancel,accept', // Validasi untuk status
        ]);

        Booking::create([
            'coffee_shop_name' => $request->coffee_shop_name,
            'name' => $request->name,
            'contact' => $request->contact,
            'start_time' => sprintf('%02d:%02d:00', $request->start_hour, $request->start_minute),
            'end_time' => sprintf('%02d:%02d:00', $request->end_hour, $request->end_minute),
            'date' => $request->date,
            'people' => $request->people,
            'booking_type' => $request->booking_type,
            'status' => $request->status, // Simpan status
            'user_id' => Auth::id(),
        ]);

        return view('pages.dashboard', ['success' => 'Booking berhasil disimpan.']);
    }

    public function create()
    {
        $coffeeShops = CoffeeShop::select('shop_name')->get();
        return view('pages.booking_form', compact('coffeeShops'));
    }


    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->get();
        $coffeeShops = CoffeeShop::select('shop_name')->get();
        return view('pages/bookingmanajemen', compact('bookings'));
    }
}
