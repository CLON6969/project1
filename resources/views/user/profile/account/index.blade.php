@extends('layouts.subscription')
@section('content')
<div class="max-w-4xl mx-auto p-4">
    
    <h1 class="text-2xl font-semibold mb-4">My Profile</h1>

    <div class="bg-white rounded shadow p-6">
        <div class="flex items-center space-x-4">
            @if($user->profile_picture)
                <img src="{{ asset('storage/'.$user->profile_picture) }}" class="w-20 h-20 rounded-full object-cover" alt="Profile Picture">
            @else
                <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center">N/A</div>
            @endif

            <div>
                <p class="text-lg font-medium">{{ $user->name }}</p>
                <p class="text-sm text-gray-500">{{ $user->email }}</p>
            </div>
        </div>

        <a href="{{ route('user.profile.account.edit') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Edit Profile</a>
    </div>
</div>



<hr class="my-8">

<div class="bg-white dark:bg-gray-900 shadow rounded-lg p-6">
    <h2 class="text-lg font-semibold text-red-600 mb-4">Delete Account</h2>
    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
        Once your account is deleted, all of its resources and data will be permanently removed. Please enter your password to confirm you want to delete your account.
    </p>

    <form method="POST" action="{{ route('user.profile.account.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
        @csrf
        @method('DELETE')

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
            <input type="password" id="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white" required>
            @error('deleteAccount.password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">
            Delete Account
        </button>
    </form>
</div>

@endsection
