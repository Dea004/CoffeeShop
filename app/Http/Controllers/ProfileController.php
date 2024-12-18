<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user instanceof \App\Models\User) {
            abort(403, 'Unauthorized access'); // Tambahkan validasi
        }

        return view('pages.profil', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        if (!$user instanceof \App\Models\User) {
            abort(403, 'Unauthorized access'); // Tambahkan validasi
        }

        return view('pages.edit_profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if (!$user instanceof \App\Models\User) {
            abort(403, 'Unauthorized access'); // Tambahkan validasi
        }

        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user->fullname = $validatedData['fullname'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'] ?? $user->phone;

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $imagePath;
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }
}
