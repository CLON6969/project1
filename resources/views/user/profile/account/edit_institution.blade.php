@extends('layouts.update')

@section('content')
<div class="max-w-4xl mx-auto p-4">
    <h2 class="text-xl font-semibold mb-4">Edit Institution Profile</h2>

    <form method="POST" action="{{ route('user.profile.account.update') }}" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf
         @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium">Institution Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-input w-full">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-input w-full">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Industry</label>
            <input type="text" name="industry" value="{{ old('industry', $user->industry) }}" class="form-input w-full">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Profile Picture</label>
            <input type="file" name="profile_picture" class="form-input w-full">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
    </form>
</div>
@endsection
