<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail; 

class ForgotPasswordController extends Controller
{
    public function sendVerificationCode(Request $request)
    {
        // Validasi email dan pastikan email ada di tabel users
        $request->validate(['email' => 'required|email|exists:users,email']);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();
        $verificationCode = rand(100000, 999999); 

        // Update kode verifikasi di database
        $user->update(['verification_code' => $verificationCode]);

        // Kirim email dengan kode verifikasi
        Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));

        return response()->json(['status' => 'success', 'message' => 'Verification code sent!']);
    }
}
