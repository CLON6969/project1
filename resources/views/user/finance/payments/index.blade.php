@extends('layouts.user_payment')

@section('title', 'My Payments')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">My Payments</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    

    @if($payments->isEmpty())
        <p class="text-gray-600">You have not made any payments yet.</p>
    @else
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Reference</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Method</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-800">
                    @foreach($payments as $index => $payment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $payment->reference }}</td>
                            <td class="px-4 py-3">ZMW {{ number_format($payment->amount, 2) }}</td>
                            <td class="px-4 py-3 capitalize">{{ $payment->payment_method }}</td>
                            <td class="px-4 py-3">
                                @if($payment->status === 'pending')
                                    <span class="text-yellow-500 font-medium">Pending</span>
                                @elseif($payment->status === 'approved')
                                    <span class="text-green-600 font-medium">Approved</span>
                                @elseif($payment->status === 'rejected')
                                    <span class="text-red-600 font-medium">Rejected</span>
                                @else
                                    <span class="text-gray-500">{{ ucfirst($payment->status) }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">{{ $payment->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-4 py-3 capitalize">
                                @if($payment->status === 'pending')
                                    <form action="{{ route('payments.cancel', $payment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this payment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Cancel</button>
                                    </form>
                                @elseif($payment->status === 'approved')
                                <div class="flex flex-1">
                                    <a href="{{ route('payments.proceed', $payment->id) }}" class="bg-cyan-800/50 hover:bg-cyan-700/70 text-black px-4 py-1 rounded-full text-xs tracking-wide shadow-sm transition">Proceed</a>
                                    <a href="{{ route('payments.show', $payment->id) }}" class="bg-indigo-800/50 hover:bg-indigo-700/70 text-black px-4 py-1 rounded-full text-xs tracking-wide shadow-sm transition">View</a>
                                    </div>

                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection