@extends('layouts.subscription')

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white dark:bg-gray-500 rounded-2xl shadow-lg">
    <h1 class="text-3xl font-semibold text-gray-800 dark:text-white mb-6">Edit Subscription</h1>

    <form action="{{ route('admin.subscriptions.update', $subscription->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Package Selection -->
        <div>
            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Package</label>
            <select name="package_id" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                @foreach ($packages as $package)
                    <option value="{{ $package->id }}" {{ $subscription->package_id == $package->id ? 'selected' : '' }}>
                        {{ $package->package_tittle }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Plan Selection -->
        <div>
            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Plan</label>
            <select name="plan_id" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                @foreach ($plans as $plan)
                    <option value="{{ $plan->id }}" {{ $subscription->plan_id == $plan->id ? 'selected' : '' }}>
                        {{ $plan->plan_tittle }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Status Selection -->
        <div>
            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Status</label>
            <select name="status" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                <option value="pending" {{ $subscription->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $subscription->status == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $subscription->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <!-- Notes -->
        <div>
            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Notes</label>
            <textarea name="notes" rows="4" class="w-full px-4 py-2 border rounded-lg resize-none focus:ring focus:ring-blue-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white">{{ $subscription->notes }}</textarea>
        </div>

        <!-- Submit Button -->
        <div class="text-right">
            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                Update Subscription
            </button>
        </div>
    </form>
</div>
@endsection
