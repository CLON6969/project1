@extends('layouts.subscription')

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white dark:bg-gray-900 rounded-2xl shadow-lg">
    <div class="mb-6">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-white mb-4">Subscription Details</h1>

        <div class="space-y-3 text-gray-700 dark:text-gray-300">
            <p><span class="font-semibold">User:</span> {{ $subscription->user->name }}</p>
            <p><span class="font-semibold">Email:</span> {{ $subscription->user->email }}</p>
            <p><span class="font-semibold">Package:</span> {{ $subscription->package->package_tittle }}</p>
            <p><span class="font-semibold">Plan:</span> {{ $subscription->plan->plan_tittle }}</p>
            <p><span class="font-semibold">Status:</span> 
                <span class="inline-block px-2 py-1 text-sm rounded-full
                    @if($subscription->status === 'approved')
                        bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                    @elseif($subscription->status === 'pending')
                        bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                    @else
                        bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                    @endif">
                    {{ ucfirst($subscription->status) }}
                </span>
            </p>
            <p><span class="font-semibold">Notes:</span> {{ $subscription->notes ?? 'None' }}</p>
        </div>
    </div>

    <div class="text-right">
        <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}"
           class="inline-block px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
            Edit Subscription
        </a>
    </div>
</div>
@endsection
