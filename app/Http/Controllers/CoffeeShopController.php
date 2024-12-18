<?php

namespace App\Http\Controllers;

use App\Models\CoffeeShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CoffeeShopController extends Controller
{
    public function index(){
        $coffeeShops = CoffeeShop::all();
        return view('pages.coffe_shops',compact('coffeeShops'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'shop_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'category' => 'required|string|max:100',
            'opening_hour' => 'required',
            'closing_hour' => 'required',
            'open_days' => 'required|string',
            'description' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'google_maps_link' => 'nullable|url',
        ]);

        try {
            // Upload file jika ada
            $profilePicturePath = null;

            if ($request->hasFile('profile_picture')) {
                // Hapus file lama jika ada
                if ($request->old_profile_picture ?? false) {
                    Storage::disk('public')->delete($request->old_profile_picture);
                }

                // Simpan file baru di folder storage/profile_pictures
                $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            }

            // Simpan data ke database
            CoffeeShop::create([
                'id_user' => auth()->id(),
                'shop_name' => $request->shop_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'category' => $request->category,
                'opening_hour' => $request->opening_hour,
                'closing_hour' => $request->closing_hour,
                'open_days' => $request->open_days,
                'description' => $request->description,
                'profile_picture' => $profilePicturePath, // Path disimpan di database
                'google_maps_link' => $request->google_maps_link,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Coffee Shop berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Gagal menyimpan Coffee Shop: ' . $e->getMessage());

            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Alamat email atau Nama CoffeShop sudah terdaftar!.');
        }
    }

    public function searchPage()
    {
        // Tampilkan halaman search kosong
        return view('pages.search');
    }

    public function search(Request $request)
    {
        // Validasi input
        $request->validate([
            'searchQuery' => 'required|string|max:255',
        ]);

        // Ambil input pencarian
        $searchQuery = $request->input('searchQuery');

        // Query database berdasarkan shop_name, address, atau category
        $results = CoffeeShop::where('shop_name', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('address', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('category', 'LIKE', "%{$searchQuery}%")
                    ->get();

        // Kirim hasil pencarian ke view
        return view('pages.search', ['results' => $results, 'searchQuery' => $searchQuery]);
    }

    

    public function show($id_shop)
    {
        // Ambil data coffee shop berdasarkan id_shop
        $coffeeShop = CoffeeShop::findOrFail($id_shop); // Jika tidak ditemukan, akan otomatis error 404

         // Kirim data ke view
        return view('pages.coffeeShop_detail', compact('coffeeShop'));
    }

    public function searchWithFilter(Request $request)
    {
        // Ambil parameter filter dari URL
        $filter = $request->input('filter');

        // Query database berdasarkan filter
        $query = CoffeeShop::query();

        if ($filter === 'kategori') {
            // Filter berdasarkan kategori (misalnya 'coffee')
            $query->where('category', 'LIKE', '%coffee%');
        } elseif ($filter === 'favorite') {
            // Filter berdasarkan daftar favorit (contoh: kondisi where tertentu)
            $query->whereHas('daftarFavorits', function ($q) {
                $q->where('user_id', auth()->id()); // Contoh filter daftar favorit user
            });
        }

        // Ambil hasil
        $results = $query->get();

        // Tampilkan hasil ke view
        return view('pages.search', ['results' => $results, 'filter' => $filter]);
    }

}