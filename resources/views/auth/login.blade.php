@extends('layouts.sigin')

@section('content')
<div class="body">
    <img class="body-img" src="{{ asset('uploads/pics/33.jpg') }}" alt="logo">

    <div class="login-container">
        <div class="login-box">
            <div class="text-center">
                <img src="{{ asset('uploads/pics/logo1.png') }}" alt="logo">
                <h2>Sign in to Kumoyo</h2>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <label>Email address</label>
                    <div class="input-wrapper">
                        <span class="icon"><i class="far fa-envelope"></i></span>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
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

                <div class="options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit" class="login-button">Sign in</button>

                <div class="separator">or</div>
                <button type="button" class="social-button google">Continue with Google</button>
                <button type="button" class="social-button facebook">Continue with Facebook</button>
                <button type="button" class="social-button apple">Continue with Apple</button>

                <p class="signup-text">New to Kumoyo? <a href="{{ route('register') }}">Sign up</a></p>
            </form>

            <p class="footer">© 2025 Powered by Kumoyo Technologies.</p>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        });
    </script>
</div>
@endsection
