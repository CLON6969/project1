@extends('layouts.admin') {{-- or your base layout --}}

@section('content')
<div class="min-h-screen bg-white dark:bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4 text-center">All Subscriptions</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-200 dark:border-gray-700 align-middle">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                        <th class="px-4 py-2 text-left">User</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Package</th>
                        <th class="px-4 py-2 text-left">Plan</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 dark:text-gray-200">
                    @foreach ($subscriptions as $sub)
                        <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                            <td class="px-4 py-2">{{ $sub->user->name }}</td>
                            <td class="px-4 py-2">{{ $sub->user->email }}</td>
                            <td class="px-4 py-2">{{ $sub->package->package_tittle ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $sub->plan->plan_tittle ?? '-' }}</td>
                            <td class="px-4 py-2 capitalize">{{ $sub->status }}</td>
                            <td class="px-4 py-2">
                                <div class="flex gap-3">
                                    <a href="{{ route('admin.subscriptions.show', $sub->id) }}" class="text-blue-600 hover:underline">View</a>
                                    <a href="{{ route('admin.subscriptions.edit', $sub->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin.subscriptions.destroy', $sub->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
