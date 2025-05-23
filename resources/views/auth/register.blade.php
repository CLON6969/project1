@extends('layouts.signup')

@section('content')
<div class="body">
    <img class="body-img" src="{{ asset('uploads/pics/33.jpg') }}" alt="background">

    <div class="login-container">
        <div class="login-box">
            <div class="text-center">
                <img src="{{ asset('uploads/pics/logo1.png') }}" alt="logo">
                <h2>Sign up for Kumoyo</h2>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
            
                <input type="hidden" name="role_id" value="3"> {{-- Assuming 3 = User --}}
                <input type="hidden" name="account_type" value="main"> {{-- or 'sub' if registering a subaccount --}}
            
                <!-- Full Name -->
                <div class="input-group">
                    <label>Full Name</label>
                    <div class="input-wrapper">
                        <span class="icon"><i class="far fa-user"></i></span>
                        <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required autofocus>
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Username (New Field) -->
                <div class="input-group">
                    <label>Username</label>
                    <div class="input-wrapper">
                        <span class="icon"><i class="fas fa-at"></i></span>
                        <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
                       
                    </div>
                    @error('username')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            
                <!-- Email -->
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

                <!-- User Type -->
                <div class="input-group">
                    <label>User Type</label>
                    <div class="input-wrapper">
                        <span class="icon"><i class="fas fa-users"></i></span>
                        <select name="user_type" required>
                            <option value="" disabled selected>Select User Type</option>
                            <option value="individual" {{ old('user_type') == 'individual' ? 'selected' : '' }}>Individual</option>
                            <option value="company" {{ old('user_type') == 'company' ? 'selected' : '' }}>Company</option>
                            <option value="institution" {{ old('user_type') == 'institution' ? 'selected' : '' }}>Institution</option>
                        </select>
                    </div>
                    @error('user_type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            
                <!-- Password -->
                <div class="input-group">
                    <label>Password</label>
                    <div class="input-wrapper">
                        <span class="icon"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" id="password" placeholder="Password" required>
                        <span id="togglePassword" class="toggle-password" title="Show/Hide">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            
                <!-- Confirm Password -->
                <div class="input-group">
                    <label>Confirm Password</label>
                    <div class="input-wrapper">
                        <span class="icon"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password_confirmation" id="confirm-password" placeholder="Confirm Password" required>
                    </div>
                </div>

                <!-- Terms Checkbox -->
                <div class="input-group checkbox-group">
                    <input type="checkbox" name="terms" id="terms" required>
                    <label for="terms">I agree to the <a href="#" target="_blank">Terms of Service</a> and <a href="#" target="_blank">Privacy Policy</a></label>
                    @error('terms')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            
                <!-- Submit -->
                <button type="submit" class="login-button">Sign up</button>
            
                <!-- Social Buttons -->
                <div class="separator">or</div>
                <button class="social-button google" type="button">
                    <i class="fab fa-google"></i> Continue with Google
                </button>
                <button class="social-button facebook" type="button">
                    <i class="fab fa-facebook-f"></i> Continue with Facebook
                </button>
                <button class="social-button apple" type="button">
                    <i class="fab fa-apple"></i> Continue with Apple
                </button>
            
                <p class="signup-text">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
            </form>
            
            <p class="footer">© 2025 Powered by Kumoyo Technologies.</p>
        </div>
    </div>

    <script>
        // Toggle Password Visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });

        // Username Suggestion (Optional)
        document.querySelector('input[name="name"]').addEventListener('blur', function() {
            if (!document.querySelector('input[name="username"]').value) {
                const suggestedUsername = this.value.trim()
                    .toLowerCase()
                    .replace(/\s+/g, '_')
                    .replace(/[^a-z0-9_]/g, '')
                    .substring(0, 15);
                
                if (suggestedUsername) {
                    document.querySelector('input[name="username"]').value = suggestedUsername;
                }
            }
        });
    </script>
</div>
@endsection