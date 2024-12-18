<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminCoffeeShopController extends Controller
{
    public function dashboard()
    {
        return view('pages.coffee-shop.dashboard_coffeeshop');
    }

    public function manageBookings()
    {
        // Ambil data booking yang terkait dengan coffee shop
        $bookings = auth()->user()->bookings;
        return view('pages.coffee-shop.manage-bookings', compact('bookings'));
    }

    public function profile()
    {
        // Ambil data profil coffee shop
        $profile = auth()->user()->profile;
        return view('pages.coffee-shop.profile', compact('profile'));
    }

    public function settings()
    {
        return view('pages.coffee-shop.settings');
    }
}
