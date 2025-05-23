@extends('layouts.admin_dashboard')

@section('content')
<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Payment Submissions</h2>

    @foreach ($payments as $payment)
        <div class="border p-4 mb-4 rounded shadow">
            <p><strong>User:</strong> {{ $payment->user->name }}</p>
            <p><strong>Method:</strong> {{ $payment->payment_method }}</p>
            <p><strong>Transaction ID:</strong> {{ $payment->transaction_id ?? 'N/A' }}</p>
            <p><strong>Notes:</strong> {{ $payment->notes }}</p>
            <p><strong>Status:</strong> <span class="font-semibold">{{ ucfirst($payment->status) }}</span></p>

            @if ($payment->screenshot_path)
                <p><strong>Screenshot:</strong><br>
                    <img src="{{ asset('storage/' . $payment->screenshot_path) }}" class="w-64 mt-2 rounded">
                </p>
            @endif

            <form action="{{ route('admin.approve_payment', $payment->id) }}" method="POST" class="mt-3">
                @csrf
                @method('PUT')
                <select name="status" class="border p-2">
                    <option value="approved">Approve</option>
                    <option value="rejected">Reject</option>
                </select>
                <button type="submit" class="ml-2 bg-green-600 text-white px-4 py-1 rounded">Update</button>
            </form>
        </div>
    @endforeach
</div>
@endsection
