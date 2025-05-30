@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Rejected Subscriptions</h2>

    @if($subscriptions->isEmpty())
        <p>No rejected subscriptions.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Plan</th>
                    <th>Status</th>
                    <th>Rejected At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscriptions as $subscription)
                    <tr>
                        <td>{{ $subscription->user->name }}</td>
                        <td>{{ $subscription->plan->name }}</td>
                        <td>{{ ucfirst($subscription->status) }}</td>
                        <td>{{ $subscription->updated_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
