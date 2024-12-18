<?php

namespace App\Http\Controllers;

use App\Models\DaftarFavorit;
use App\Models\CoffeeShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarFavoritController extends Controller
{
    // Fungsi untuk menambah ke daftar favorit
    public function store($id_shop)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to add to favorites.');
        }

        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Menambahkan entry ke daftar favorit
        DaftarFavorit::create([
            'id_shop' => $id_shop,
            'user_id' => $user->id,
        ]);

        return redirect()->back()->with('success', 'Coffee shop added to favorites!');
    }
}
