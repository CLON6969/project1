@extends('layouts.user_payment')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Expenses</h2>
        <a href="{{ route('expenses.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Expense</a>
    </div>

    <div class="bg-white shadow rounded p-4">
        <table class="w-full table-auto">
            <thead>
                <tr class="text-left text-gray-600 text-sm border-b">
                    <th>Title</th>
                    <th>Amount</th>
                    <th>Category</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($expenses as $expense)
                    <tr class="border-b">
                        <td class="py-2">{{ $expense->title }}</td>
                        <td class="py-2 text-red-500">ZMW {{ number_format($expense->amount, 2) }}</td>
                        <td class="py-2">{{ $expense->category ?? '-' }}</td>
                        <td class="py-2">{{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">No expenses found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
