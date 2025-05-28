@extends('layouts.user_payment')


@section('content')
<div class="p-6 space-y-6">
    <h2 class="text-2xl font-bold">Financial Summary</h2>

    <div class="grid md:grid-cols-3 gap-6">
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-lg font-semibold text-gray-700">Total Payments</h3>
            <p class="text-2xl font-bold text-green-600 mt-2">ZMW {{ number_format($totalPayments, 2) }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-lg font-semibold text-gray-700">Total Expenses</h3>
            <p class="text-2xl font-bold text-red-500 mt-2">ZMW {{ number_format($totalExpenses, 2) }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-lg font-semibold text-gray-700">Total Budget</h3>
            <p class="text-2xl font-bold text-blue-500 mt-2">ZMW {{ number_format($totalBudgets, 2) }}</p>
        </div>
    </div>

    <div class="bg-white p-4 rounded shadow mt-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Unpaid Invoices</h3>
        <table class="w-full table-auto">
            <thead>
                <tr class="text-gray-600 border-b">
                    <th>Invoice #</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($unpaidInvoices as $invoice)
                    <tr class="border-b">
                        <td class="py-2">{{ $invoice->number }}</td>
                        <td class="py-2 text-red-500">ZMW {{ number_format($invoice->amount, 2) }}</td>
                        <td class="py-2">{{ \Carbon\Carbon::parse($invoice->due_date)->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center py-4 text-gray-500">All invoices are paid.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection