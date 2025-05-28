@extends('layouts.user_payment')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">Create New Budget</h2>

    <form method="POST" action="{{ route('budgets.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Category</label>
            <input type="text" name="category" class="w-full border border-gray-300 p-2 rounded" required>
            @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Amount</label>
            <input type="number" step="0.01" name="amount" class="w-full border border-gray-300 p-2 rounded" required>
            @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Start Date</label>
            <input type="date" name="start_date" class="w-full border border-gray-300 p-2 rounded" required>
            @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">End Date</label>
            <input type="date" name="end_date" class="w-full border border-gray-300 p-2 rounded" required>
            @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create Budget</button>
        </div>
    </form>
</div>
@endsection
