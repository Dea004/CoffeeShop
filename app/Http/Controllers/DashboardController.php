<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CoffeeShop;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Mendapatkan data pengguna login, jika ada
        $coffeeShop = null;
        $hasShop = false;

        if ($user) {
            // Jika pengguna login, cek apakah dia memiliki coffee shop
            $coffeeShop = CoffeeShop::where('id_user', $user->id)->first();
            $hasShop = $coffeeShop ? true : false;
        }

        return view('pages.dashboard', compact('coffeeShop', 'hasShop'));
    }
}

