@extends('layouts.subscription')

@section('content')
<div class="payment-container">
  <h2>Subscription Submitted!</h2>
  <p>Thank you for selecting a plan. Your subscription request has been received and is pending admin approval.</p>

  <div style="margin-top: 2rem;">
    <a href="{{ route('user.dashboard') }}" class="submit-btn">Return to Dashboard</a>
  </div>
</div>
@endsection
