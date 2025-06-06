@extends('layouts.user_payment')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">Create New Invoice</h2>

    <form method="POST" action="{{ route('invoices.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Invoice Number</label>
            <input type="text" name="number" class="w-full border border-gray-300 p-2 rounded" required>
            @error('number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Description</label>
            <textarea name="description" class="w-full border border-gray-300 p-2 rounded" rows="2"></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Amount</label>
            <input type="number" step="0.01" name="amount" class="w-full border border-gray-300 p-2 rounded" required>
            @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Due Date</label>
            <input type="date" name="due_date" class="w-full border border-gray-300 p-2 rounded">
            @error('due_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save Invoice</button>
        </div>
    </form>
</div>
@endsection
