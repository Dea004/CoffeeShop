<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('pages/dashboard');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // Periksa apakah email terdaftar
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            return response()->json([
                'errors' => [
                    'email' => 'Email tidak terdaftar. Silakan daftar terlebih dahulu.'
                ]
            ], 422); 
        }
    
        // Periksa autentikasi
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'errors' => [
                    'password' => 'Password salah. Silakan coba lagi.'
                ]
            ], 422);
        }
    
        // Regenerasi sesi dan arahkan ke dashboard
        $request->session()->regenerate();
    
        // Jika login berhasil, kirimkan respon sukses
        return response()->json(['message' => 'Login berhasil!'], 200);
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->role == 'coffee_shop_owner') {
            return redirect()->route('coffeeshop.bookings');
        }

        return redirect()->route('home');
    }



    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        // Redirect dengan parameter logout=true
        return redirect()->route('dashboard')->with('logout', true);
    }
    
}
