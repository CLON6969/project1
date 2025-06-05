@extends('layouts.subscription')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Pending Subscriptions</h1>
    <x-subscription-table :subscriptions="$subscriptions" status="pending" />
@endsection
```