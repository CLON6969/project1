@extends('layouts.user_payment')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded">
    <h2 class="text-2xl font-semibold mb-4">Payment Details</h2>

    <div class="grid gap-4">
        <p><strong>Amount:</strong> {{ number_format($payment->amount, 2) }}</p>
        <p><strong>Payment Method:</strong> {{ ucfirst($payment->payment_method) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>
        <p><strong>Transaction ID:</strong> {{ $payment->transaction_id }}</p>
        <p><strong>Paid At:</strong> {{ $payment->paid_at }}</p>
        <p><strong>Narration:</strong> {{ $payment->narration }}</p>
    </div>
</div>
@endsection
