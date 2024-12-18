<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function resetPassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'newPassword' => 'required|min:6|confirmed',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Update password
        $user->update([
            'password' => Hash::make($request->newPassword),
        ]);

        return redirect()->route('login.submit')->with('success', 'Password successfully updated.');
    }
}
