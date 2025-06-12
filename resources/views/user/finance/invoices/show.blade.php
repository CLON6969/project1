@extends('layouts.user_payment')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Invoice Details</h2>

    <div class="space-y-4">
        <div>
            <strong>Invoice Number:</strong> {{ $invoice->number }}
        </div>
        <div>
            <strong>Description:</strong> {{ $invoice->description ?? 'N/A' }}
        </div>
        <div>
            <strong>Amount:</strong> ZMW {{ number_format($invoice->amount, 2) }}
        </div>
        <div>
            <strong>Due Date:</strong> {{ \Carbon\Carbon::parse($invoice->due_date)->format('d M Y') }}
        </div>
        <div>
            <strong>Status:</strong>
            @if($invoice->is_paid)
                <span class="text-green-600 font-semibold">Paid</span>
            @else
                <span class="text-red-500">Unpaid</span>
            @endif
        </div>
        @if($invoice->payment)
        <hr>
        <h3 class="text-lg font-semibold">Payment Info</h3>
        <div>
            <strong>Paid On:</strong> {{ $invoice->payment->paid_at ? $invoice->payment->paid_at->format('d M Y H:i') : '-' }}
        </div>
        <div>
            <strong>Method:</strong> {{ ucfirst($invoice->payment->payment_method) }}
        </div>
        <div>
            <strong>Reference:</strong> {{ $invoice->payment->reference }}
        </div>
        <div>
            <strong>Gateway Response:</strong> {{ $invoice->payment->gateway_response ?? 'N/A' }}
        </div>
        <div>
            <strong>Status:</strong> <span class="text-green-600">Success</span>
        </div>
        @endif
    </div>

    <div class="mt-6">
        <a href="{{ route('user.finance.invoices.index') }}"
           class="text-sm text-blue-600 hover:underline">← Back to Invoices</a>
    </div>
</div>
@endsection
