@extends('layouts.update')

@section('content')
<link href="{{ asset('css/profile-form.css') }}" rel="stylesheet">

<div class="profile-form-container">
    <h2>Complete Your Institution Profile</h2>

    <form action="{{ route('logout') }}" method="POST" style="text-align: right; margin-bottom: 1rem;">
    @csrf
    <button type="submit" class="btn-danger" style="background:red; padding: 10px;">Logout</button>
</form>

    @if ($errors->any())
        <div class="status-message bg-red-100 text-red-700 p-4 rounded mb-6 border border-red-300">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="profile-form-grid">
            <div class="form-group">
                <label for="name">Institution Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="username">Username *</label>
                <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" required>
            </div>

            <div class="form-group">
                <label for="website">Website</label>
                <input type="url" name="website" id="website" value="{{ old('website', $user->website) }}">
            </div>

            <div class="form-group">
                <label for="organization_type">Organization Type</label>
                <input type="text" name="organization_type" id="organization_type" value="{{ old('organization_type', $user->organization_type) }}">
            </div>

            <div class="form-group">
                <label for="industry">Industry</label>
                <input type="text" name="industry" id="industry" value="{{ old('industry', $user->industry) }}"  required>
            </div>

            <div class="form-group">
                <label for="tax_id">Tax ID</label>
                <input type="text" name="tax_id" id="tax_id" value="{{ old('tax_id', $user->tax_id) }}" >
            </div>

            <div class="form-group">
                <label for="organization_size">Organization Size</label>
                <input type="text" name="organization_size" id="organization_size" value="{{ old('organization_size', $user->organization_size) }}">
            </div>

            <div class="form-group">
                <label for="company_registration_number">Registration Number</label>
                <input type="text" name="company_registration_number" id="company_registration_number" value="{{ old('company_registration_number', $user->company_registration_number) }}">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}">
            </div>

            <div class="form-group">
                <label for="bio">Institution Bio</label>
                <textarea name="bio" id="bio" rows="4">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <div class="form-group">
                <label for="referral_source">Referral Source</label>
                <input type="text" name="referral_source" id="referral_source" value="{{ old('referral_source', $user->referral_source) }}">
            </div>

            <div class="form-group">
                <label for="business_license_path">Business License (PDF or Image)</label>
                <input type="file" name="business_license_path" id="business_license_path" accept=".pdf,image/*">
            </div>

            <div class="form-group">
                <label for="id_document_path">ID Document (PDF or Image)</label>
                <input type="file" name="id_document_path" id="id_document_path" accept=".pdf,image/*">
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture" accept="image/jpeg,image/png">
            </div>
        </div>

        <button type="submit">Save and Continue</button>
    </form>
</div>
@endsection