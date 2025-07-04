@extends('layouts.update')

@section('content')


<div class="profile-form-container">
    
    <h2>Complete Your Profile</h2>

<form action="{{ route('logout') }}" method="POST" style="text-align: right; margin-bottom: 1rem;">
    @csrf
    <button type="submit" class="btn-danger" style="background:red; padding: 10px;">Logout</button>
</form>


    <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="profile-form-grid">
            {{-- Required Fields --}}
            <div class="form-group">
                <label for="name">Full Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required minlength="2" maxlength="255">
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required maxlength="255">
            </div>

            {{-- Optional but encouraged fields --}}
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" pattern="^\+?[0-9\-]{7,20}$" maxlength="20">
            </div>



            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}" maxlength="255">
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}" maxlength="100">
            </div>

            <div class="form-group">
                <label for="state">State</label>
                <input type="text" name="state" id="state" value="{{ old('state', $user->state) }}" maxlength="100">
            </div>

            <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $user->postal_code) }}" maxlength="20">
            </div>

            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" name="country" id="country" value="{{ old('country', $user->country) }}" maxlength="100">
            </div>

            <div class="form-group">
                <label for="website">Website</label>
                <input type="url" name="website" id="website" value="{{ old('website', $user->website) }}" maxlength="255">
            </div>

            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea name="bio" id="bio" rows="4" maxlength="1000">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <div class="form-group">
                <label for="referral_source">Referral Source</label>
                <input type="text" name="referral_source" id="referral_source" value="{{ old('referral_source', $user->referral_source) }}" maxlength="255">
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture (jpg/png, max 2MB)</label>
                <input type="file" name="profile_picture" id="profile_picture" accept="image/jpeg,image/png">
            </div>

            <div class="form-group">
                <label for="id_document_path">Government ID (pdf/jpg/png, max 4MB)</label>
                <input type="file" name="id_document_path" id="id_document_path" accept=".pdf,image/jpeg,image/png">
            </div>
        </div>

        <button type="submit">Save and Continue</button>
    </form>
    
</div>
@endsection
