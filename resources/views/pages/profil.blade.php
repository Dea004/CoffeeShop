<!-- resources/views/pages/profile.blade.php -->
@extends('layouts.main_profil')

@section('content')
<div class="header-wrapper mb-8">
    <div id="welcomeMessage" class="header-title text-primary text-center md:text-left">
        <h2 class="text-4xl font-bold text-gray-800">Welcome, {{ $user->username }}!</h2>
        <p class="text-lg text-gray-600">Manage your account details and settings here</p>
    </div>
</div>

<div id="userProfile" class="bg-white p-8 rounded-2xl shadow-lg mb-8 flex flex-col md:flex-row gap-8">
    <!-- Profile Picture Section -->
    <div class="user-property flex justify-center md:justify-start">
    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="w-40 h-40 md:w-48 md:h-48 rounded-full shadow-md border-4 border-gray-200 object-cover">
    </div>

    <!-- User Details Section -->
    <div class="user-detail flex flex-col gap-6 w-full md:w-3/4">
        <div class="detail-grid grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Full Name -->
            <div class="detail-item bg-gray-50 p-6 rounded-lg shadow-sm flex flex-col">
                <span class="text-gray-500 font-semibold">Full Name:</span>
                <span class="text-gray-800 text-lg font-medium">{{ $user->fullname }}</span>
            </div>
            <!-- Username -->
            <div class="detail-item bg-gray-50 p-6 rounded-lg shadow-sm flex flex-col">
                <span class="text-gray-500 font-semibold">Username:</span>
                <span class="text-gray-800 text-lg font-medium">{{ $user->username }}</span>
            </div>
            <!-- Email -->
            <div class="detail-item bg-gray-50 p-6 rounded-lg shadow-sm flex flex-col">
                <span class="text-gray-500 font-semibold">Email:</span>
                <span class="text-gray-800 text-lg font-medium">{{ $user->email }}</span>
            </div>
            <!-- Phone Number -->
            <div class="detail-item bg-gray-50 p-6 rounded-lg shadow-sm flex flex-col">
                <span class="text-gray-500 font-semibold">Phone Number:</span>
                <span class="text-gray-800 text-lg font-medium">{{ $user->phone }}</span>
            </div>
        </div>
        <div class="flex justify-center md:justify-start mt-6">
            <a href="{{ route('profile.edit') }}" class="inline-block px-6 py-3 mt-4 bg-blue-600 text-white font-semibold text-center rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Edit Profile
            </a>
        </div>
    </div>
</div>
@endsection
