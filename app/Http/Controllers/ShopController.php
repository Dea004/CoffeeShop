<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\CoffeeShop;
use App\Models\Booking;

class ShopController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user instanceof \App\Models\User) {
            abort(403, 'Unauthorized access');
        }

        $coffeeShop = CoffeeShop::where('id_user', $user->id)->first();

        if (!$coffeeShop) {
            abort(404, 'Toko tidak ditemukan.');
        }

        // Mengambil data booking berdasarkan coffee shop id
        $bookings = Booking::where('coffee_shop_name', $coffeeShop->shop_name)->get();

        return view('pages.shop_manajemen', compact('coffeeShop', 'bookings'));
    }

    public function edit()
    {
        $user = Auth::user();
        if (!$user instanceof \App\Models\User) {
            abort(403, 'Unauthorized access');
        }

        $coffeeShop = CoffeeShop::where('id_user', $user->id)->first();

        if (!$coffeeShop) {
            abort(404, 'Toko tidak ditemukan.');
        }

        return view('pages.shop_edit', compact('coffeeShop'));
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'shop_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'opening_hour' => 'required',
            'closing_hour' => 'required',
            'open_days' => 'required|string|max:50',
            'description' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'google_maps_link' => 'nullable|url',
        ]);

        // Ambil data toko milik user yang sedang login
        $coffeeShop = CoffeeShop::where('id_user', Auth::id())->first();

        if (!$coffeeShop) {
            return redirect()->back()->with('error', 'Toko tidak ditemukan.');
        }

        // Update data toko
        $data = $request->only([
            'shop_name', 'email', 'phone_number', 'address',
            'category', 'opening_hour', 'closing_hour',
            'open_days', 'description', 'google_maps_link'
        ]);

        // Menghandle upload gambar jika ada
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('profile_pictures', $filename, 'public');
            $data['profile_picture'] = $filePath;
        }

        $coffeeShop->update($data);

        return redirect()->route('shop.index')->with('success', 'Data toko berhasil diperbarui.');
    }

    public function updateBookingStatus(Request $request, $bookingId)
    {
        $user = Auth::user();
        if (!$user instanceof \App\Models\User) {
            abort(403, 'Unauthorized access');
        }

        $booking = Booking::find($bookingId);
        if (!$booking || $booking->coffee_shop_name != $request->coffee_shop_name) {
            abort(404, 'Booking tidak ditemukan atau tidak memiliki akses.');
        }

        $validatedData = $request->validate([
            'status' => 'required|in:accept,cancel',
        ]);

        // Update status booking
        $booking->status = $validatedData['status'];
        $booking->save();

        return redirect()->route('shop.index')->with('success', 'Status booking berhasil diperbarui!');
    }
}
