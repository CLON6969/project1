@extends('layouts.contact')

@section('content')
<div class="container">
    <div class="left-section">
        <img src="{{ asset('uploads/pics/83.jpg') }}" alt="logo">
        <div class="overlay">
            <h1>Kumoyo Platform</h1>
            <h2>Talk to our sales team</h2>
            <ul>
                <li>Get started with a free trial or a demo</li>
                <li>Learn about our products and solutions</li>
                <li>Find the best kumoyo plan tailored to your business's unique needs</li>
                <li>Need customer support? Contact Enterprise Support</li>
                <li>Kumoyo partners with industry leaders</li>
            </ul>
        </div>
    </div>



    <div class="right-section">

@if(session('success'))
    <div class="alert-success fade-in" id="successAlert">
        <span>{{ session('success') }}</span>
        <button onclick="fadeOut()" class="close-btn">×</button>
    </div>
@endif


        <form method="POST" action="{{ route('contact.submit') }}">
            @csrf
            <label>First name *</label>
            <input type="text" name="first_name" required>

            <label>Last name *</label>
            <input type="text" name="last_name" required>

            <label>Company *</label>
            <input type="text" name="company" required>

            <label>Job title *</label>
            <input type="text" name="job_title" required>

            <label>Work email *</label>
            <input type="email" name="email" required>

            <label>Phone number</label>
            <input type="tel" name="phone">

            <label>Message</label>
            <textarea name="message" rows="4" placeholder="Describe your project, needs, and timeline."></textarea>

            <label>Country *</label>
            <select name="country" required>
                <option value="">Select</option>
                <option value="USA">USA</option>
                <option value="UK">UK</option>
            </select>

            <div class="checkbox-container">
                <input type="checkbox" name="consent" value="1">
                <p>Yes please, I’d like kumoyo and affiliates to use my information for personalized communications...</p>
            </div>

            <button type="submit">Contact sales →</button>
        </form>
    </div>
</div>

<script>
    function fadeOut() {
        const alert = document.getElementById('successAlert');
        alert.classList.remove('fade-in');
        alert.classList.add('fade-out');
        setTimeout(() => {
            alert.style.display = 'none';
        }, 600); // Match CSS transition duration
    }

    // Optional auto-dismiss after 5 seconds
    window.addEventListener('load', () => {
        setTimeout(() => {
            fadeOut();
        }, 5000);
    });
</script>


@endsection
