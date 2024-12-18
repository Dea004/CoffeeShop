<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username',
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed',  
        ]);

        // If validation fails, return errors
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); 
        }

       

        // Store user data in the database
        $user = User::create([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Return success message
        return response()->json(['message' => 'Registration successful!'], 200);
    }
}
