@extends('layouts.user_payment')

@section('content')
<div class="p-6">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded p-4">
        <table class="w-full table-auto text-left">
            <thead>
                <tr class="text-gray-600 border-b">
                    <th>Invoice #</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoices as $invoice)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2">{{ $invoice->number }}</td>
                        <td class="py-2">{{ $invoice->description ?? '-' }}</td>
                        <td class="py-2 text-green-600">ZMW {{ number_format($invoice->amount, 2) }}</td>
                        <td class="py-2">{{ $invoice->due_date ? \Carbon\Carbon::parse($invoice->due_date)->format('d M Y') : '-' }}</td>
                        <td class="py-2">
                            @if($invoice->is_paid)
                                <span class="text-green-600 font-semibold">Paid</span>
                            @else
                                <span class="text-red-500">Unpaid</span>
                            @endif
                        </td>
                        <td class="py-2 flex space-x-2">
    @if(!$invoice->is_paid)
        <a href="{{ route('user.finance.invoices.pay', $invoice->id) }}"
           class="bg-blue-500 hover:bg-blue-600 text-black px-3 py-1 rounded text-sm">
            Pay Now
        </a>
    @else
        <a href="{{ route('user.finance.invoices.view', $invoice->id) }}"
           class="bg-green-500 hover:bg-green-600 text-black px-3 py-1 rounded text-sm">
            View
        </a>
    @endif
</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">No invoices found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
