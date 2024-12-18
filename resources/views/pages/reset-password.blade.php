@extends('layouts.main')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow-lg w-96">
        <h2 class="text-2xl font-semibold text-center mb-4">Reset Password</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email address</label>
                <input class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#814e2b]" 
                    type="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium">New Password</label>
                <input class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#814e2b]" 
                    type="password" name="password" required>
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium">Confirm Password</label>
                <input class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#814e2b]" 
                    type="password" name="password_confirmation" required>
            </div>
            <div class="mt-4">
                <button type="submit" style="background-color: #814e2b;" 
                        class="w-full px-4 py-2 text-white font-semibold rounded hover:bg-[#663d21]">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
