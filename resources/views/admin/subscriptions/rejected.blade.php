@extends('layouts.subscription')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Rejected Subscriptions</h1>
    <x-subscription-table :subscriptions="$subscriptions" status="rejected" />
@endsection