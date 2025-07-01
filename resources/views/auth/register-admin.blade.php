@php 
    $logo = App\Models\Logo::first(); // Changed from $icons = ... to $logo = ...
@endphp
@extends('layouts.signup')

@section('content')
<div class="body">
      <img class="body-img" src="{{ asset('storage/uploads/pics/'  . $logo->background_picture) }}" alt="background">

    <div class="login-container">
        <div class="login-box">
            <div class="text-center">
                < <img src="{{ asset('storage/uploads/pics/' . $logo->picture) }}" alt="logo">
                <h2>Admin Sign Up</h2>
            </div>

            <form method="POST" action="{{ route('register.admin') }}">
                @csrf

                <input type="hidden" name="role_id" value="1"> {{-- assuming 1 = Admin --}}
                <input type="hidden" name="account_type" value="main">>

                @include('auth.partials.signup-form-fields')

                <button type="submit" class="login-button">Sign up</button>

                <div class="separator">or</div>
                <button class="social-button google">Continue with Google</button>
                <button class="social-button facebook">Continue with Facebook</button>
                <button class="social-button apple">Continue with Apple</button>

                <p class="signup-text">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
            </form>

            <p class="footer">© 2025 Powered by Kumoyo Technologies.</p>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        });
    </script>
</div>
@endsection






