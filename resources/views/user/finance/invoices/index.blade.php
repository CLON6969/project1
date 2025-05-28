@extends('layouts.user_payment')


@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Invoices</h2>
        <a href="{{ route('invoices.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ New Invoice</a>
    </div>

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
                </tr>
            </thead>
            <tbody>
                @forelse($invoices as $invoice)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2">{{ $invoice->number }}</td>
                        <td class="py-2">{{ $invoice->description ?? '-' }}</td>
                        <td class="py-2 text-green-600">ZMW {{ number_format($invoice->amount, 2) }}</td>
                        <td class="py-2">{{ $invoice->due_date ? \Carbon\Carbon::parse($invoice->due_date)->format('d M Y') : '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center py-4 text-gray-500">No invoices found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
