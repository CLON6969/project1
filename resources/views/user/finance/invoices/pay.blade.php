@extends('layouts.user_payment')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 shadow-md rounded">
    <h2 class="text-xl font-semibold mb-4">Pay Invoice #{{ $invoice->number }}</h2>

    <form action="{{ route('user.finance.invoices.pay.submit', $invoice->id) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-medium">Invoice Amount:</label>
            <p class="text-green-600 font-bold">ZMW {{ number_format($invoice->amount, 2) }}</p>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Payment Method <span class="text-red-500">*</span></label>
            <select name="payment_method" required class="w-full border-gray-300 rounded">
                <option value="">-- Select --</option>
                <option value="mobile">Mobile</option>
                <option value="card">Card</option>
                <option value="bank">Bank</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Reference Number <span class="text-red-500">*</span></label>
            <input type="text" name="reference" required readonly
                   value="{{ $reference }}"
                   class="w-full border-gray-300 rounded bg-gray-100 text-gray-700">
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Submit Payment for Approval
            </button>
        </div>
    </form>
</div>
@endsection
