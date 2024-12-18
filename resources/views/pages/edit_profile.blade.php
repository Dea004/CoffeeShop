<!-- resources/views/pages/edit_profile.blade.php -->
@extends('layouts.main_profil')

@section('content')
<div class="header-wrapper mb-8">
    <div id="welcomeMessage" class="header-title text-primary text-center md:text-left">
        <h2 class="text-4xl font-bold text-gray-800">Edit Profile</h2>
        <p class="text-lg text-gray-600">Update your profile details below</p>
    </div>
</div>

<div id="editProfileForm" class="bg-white p-8 rounded-2xl shadow-lg mb-8">
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-6">
            <label for="fullname" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text" id="fullname" name="fullname" value="{{ $user->fullname }}" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-6">
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input type="text" id="phone" name="phone" value="{{ $user->phone }}" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm" maxlength="20">
        </div>

        <div class="mb-6">
            <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile Picture</label>
            <input type="file" id="profile_picture" name="profile_picture" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm">
        </div>

        <div class="flex justify-between">
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700">Save Changes</button>
            <a href="{{ route('profile.edit') }}" class="bg-gray-500 text-white px-6 py-3 rounded-md hover:bg-gray-600">Cancel</a>
        </div>
    </form>
</div>
@endsection
