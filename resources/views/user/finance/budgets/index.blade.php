@extends('layouts.user_payment')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Budgets</h2>
        <a href="{{ route('budgets.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ New Budget</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded p-4">
        <table class="w-full text-left table-auto">
            <thead>
                <tr class="text-gray-600 border-b">
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Start</th>
                    <th>End</th>
                </tr>
            </thead>
            <tbody>
                @forelse($budgets as $budget)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2">{{ $budget->category }}</td>
                        <td class="py-2 text-green-700">ZMW {{ number_format($budget->amount, 2) }}</td>
                        <td class="py-2">{{ \Carbon\Carbon::parse($budget->start_date)->format('d M Y') }}</td>
                        <td class="py-2">{{ \Carbon\Carbon::parse($budget->end_date)->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">No budget records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
