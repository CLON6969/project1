@extends('layouts.signup')

@section('content')
<div class="body">
    <img class="body-img" src="{{ asset('uploads/pics/33.jpg') }}" alt="logo">

    <div class="login-container">
        <div class="login-box">
            <div class="text-center">
                <img src="{{ asset('uploads/pics/logo1.png') }}" alt="logo">
                <h2>Sign up for Kumoyo</h2>
            </div>

            <form method="POST" action="{{ route('register.staff') }}">

                @csrf
                <input type="hidden" name="role_id" value="2"> {{-- assuming 2 = Staff --}}
                <input type="hidden" name="account_type" value="main"> {{-- or 'sub' if being created by another account --}}
                <div class="input-group">
                    <label>Full Name</label>
                    <div class="input-wrapper">
                        <span class="icon"><i class="far fa-user"></i></span>
                        <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <label>Email address</label>
                    <div class="input-wrapper">
                        <span class="icon"><i class="far fa-envelope"></i></span>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <div class="input-wrapper">
                        <span class="icon"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" id="password" placeholder="Password" required>
                        <span id="togglePassword" class="toggle-password"><i class="fas fa-eye"></i></span>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <label>Confirm Password</label>
                    <div class="input-wrapper">
                        <span class="icon"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password_confirmation" id="confirm-password" placeholder="Confirm Password" required>
                    </div>
                </div>

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


