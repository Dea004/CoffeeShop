<?php

namespace App\Http\Controllers;

use App\Models\DaftarFavorit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        // Ambil data favorit berdasarkan user yang sedang login
        $favorites = DaftarFavorit::with('coffeeShop') // Eager load relasi coffeeShop
        ->where('user_id', Auth::id())
        ->get();

        // Ambil data favorit berdasarkan pengguna yang sedang login
        $favorites = DaftarFavorit::where('user_id', Auth::id())->get();

        // Kirim data favorit ke view
        return view('pages/DaftarFavorite', compact('favorites'));
    }

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

        // Menambahkan pesan session untuk notifikasi
        return redirect()->back()->with('success', 'Coffee shop added to favorites!');
    }

}
