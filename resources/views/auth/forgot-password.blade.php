@extends('layouts.sigin')
<style>/* auth.css */
@import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap');

body {
    margin: 0;
    padding: 0;
    font-family: 'Orbitron', sans-serif;
    background: linear-gradient(135deg, #0f172a, #1e293b);
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.reset-container {
    background: rgba(20, 30, 60, 0.5);
    border: 1px solid rgba(0, 122, 255, 0.3);
    backdrop-filter: blur(14px);
    box-shadow: 0 8px 32px 0 rgba(0, 122, 255, 0.3);
    border-radius: 20px;
    padding: 40px;
    width: 100%;
    max-width: 420px;
    color: #e0f2ff;
    text-shadow: 0 0 5px rgba(0, 170, 255, 0.3);
}

.reset-container p {
    font-size: 14px;
    color: #cbe8ff;
    margin-bottom: 20px;
}

.reset-container label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: #90cdf4;
}

.reset-container input[type="email"] {
    width: 100%;
    padding: 12px;
    background: rgba(0, 40, 80, 0.3);
    border: 1px solid #3b82f6;
    border-radius: 10px;
    color: #ffffff;
    outline: none;
    transition: 0.3s ease;
    box-shadow: inset 0 0 10px rgba(0, 170, 255, 0.1);
}

.reset-container input[type="email"]:focus {
    border-color: #60a5fa;
    box-shadow: 0 0 15px rgba(0, 170, 255, 0.4);
}

.reset-container .error {
    color: #f87171;
    font-size: 12px;
    margin-top: 5px;
}

.reset-container .status {
    margin-bottom: 20px;
    color: #4ade80;
    font-size: 14px;
}

.reset-container .submit-button {
    margin-top: 20px;
    background: linear-gradient(90deg, #2563eb, #3b82f6);
    color: #ffffff;
    padding: 12px 25px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    font-weight: bold;
    font-size: 14px;
    transition: all 0.3s ease-in-out;
    width: 100%;
    box-shadow: 0 0 10px rgba(59, 130, 246, 0.6);
}

.reset-container .submit-button:hover {
    box-shadow: 0 0 20px #3b82f6, 0 0 30px #2563eb;
    transform: scale(1.03);
}
</style>
@section('content')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">

<div class="reset-container">
    <p>
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </p>

    @if (session('status'))
        <div class="status">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="submit-button">
            {{ __('Email Password Reset Link') }}
        </button>
    </form>
</div>
@endsection
