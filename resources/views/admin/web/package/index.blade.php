@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Packages</h1>

    <a href="{{ route('admin.web.package.create') }}" class="btn btn-primary mb-3">+ Create New Package</a>

    @foreach($packages as $package)
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>{{ $package->package_tittle }}</h5>
                <div class="btn-group">
                    <a href="{{ route('admin.web.package.edit', $package) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.web.package.destroy', $package) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <p>{{ $package->statement }}</p>

                @foreach($package->plans as $plan)
                    <div class="mb-3">
                        <strong>Plan:</strong> {{ $plan->plan_tittle }} - {{ $plan->amount }} {{ $plan->currency }}
                        <ul>
                            @foreach($plan->features as $feature)
                                <li>{{ $feature->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection


