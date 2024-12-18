<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_cafe' => 'required|string|max:255',
            'ulasan' => 'required|string|max:1000',
            'rating' => 'required|integer|between:1,5',
        ]);

        // Simpan ke database
        $review = new Review();
        $review->nama_cafe = $request->nama_cafe;
        $review->ulasan = $request->ulasan;
        $review->rating = $request->rating;
        $review->tanggal_ulasan = Carbon::now();
        $review->save();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Ulasan berhasil ditambahkan!');
    }

    public function show($cafeSlug)
    {
        $reviews = Review::where('nama_cafe', $cafeSlug)->get(); // Ambil review berdasarkan nama cafe
        return view('pages.coffee_shops.rutukopi', compact('reviews')); // Kirim data ke view
    }
}
