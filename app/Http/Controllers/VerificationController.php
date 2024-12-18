<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class VerificationController extends Controller
{
    public function verifyCode(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'verificationCode' => 'required|digits:6',
        ]);

        // Cari user berdasarkan email dan kode verifikasi
        $user = User::where('email', $request->email)
                    ->where('verification_code', $request->verificationCode)
                    ->first();

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Invalid verification code.'], 400);
        }

        // Tandai email sudah diverifikasi
        $user->update([
            'verification_code' => null,
            'email_verified_at' => now(),
        ]);

        return response()->json(['status' => 'success', 'message' => 'Email verified successfully.']);
    }
}
