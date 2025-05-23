@extends('layouts.plan-detail')
@push('styles')

    @if ($plan->id == 1)
        <link href="{{ asset('resources/css/basic.css') }}" rel="stylesheet">
    @elseif ($plan->id == 2)
        <link href="{{ asset('resources/css/standard.css') }}" rel="stylesheet">
    @elseif ($plan->id == 3)
        <link href="{{ asset('resources/css/premium.css') }}" rel="stylesheet">
    @endif
@endpush

@section('content')





<div class="home-title">
    <button>{{ $plan->plan_tittle }} <i class="fas fa-volleyball-ball"></i></button>
    <p>{{ $plan->content1 }}</p>
</div>

<div class="plan-container">

    <div class="plan-header-container"> 
        <div class="plan-header"> 
            <img src="{{ asset('uploads/pics/logo2.png') }}" alt="logo"> 
            <div class="plan-header-tittle">
                <p>{{ $plan->plan_tittle }}</p> 
            </div> 
        </div>

        <div class="maintenance-container">
            <p class="maintenance">100% Maintenance Fee (Annual)</p>
        </div>
    </div>

    <div class="premium-header">
        <h1>{{ $plan->currency }} {{ number_format($plan->amount, 2) }}</h1>
        <p class="free-hosting">Free Hosting</p>
        <div class="choice">{{ $plan->button1_name }}</div>
    </div>

    <div class="features">
        <ul>
            @foreach ($plan->features as $feature)
            <li>{{ $feature->name }}</li>
            @endforeach
        </ul>
    </div>

    <div class="addtional-section">
        <h4 class="additional-benefits">Additional Benefits</h4>
        <ul>
            <li>• Hosting: Free 200GB storage with automated backups.</li>
            <li>• Customization: Fully customizable theme design to match branding.</li>
            <li>• Support: Dedicated account manager, priority support, and 24/7 support.</li>
            <li>• Maintenance Fee (Annual): 12% of the initial cost (after year one).</li>
        </ul>
    </div>

    <div class="core-section">
        <h4 class="additional-benefits">CORE</h4>

        @foreach ($packages as $package)
        <ul>
            <li><strong>{{ $package->tittle1 }}:</strong> {{ $package->tittle1_content }}</li>
            <li><strong>{{ $package->tittle2 }}:</strong> {{ $package->tittle2_content }}</li>
            <li><strong>{{ $package->tittle3 }}:</strong> {{ $package->tittle3_content }}</li>
            <li><strong>{{ $package->tittle4 }}:</strong> {{ $package->tittle4_content }}</li>
            <li><strong>{{ $package->tittle5 }}:</strong> {{ $package->tittle5_content }}</li>
        </ul>
        @endforeach

    </div>
    


   


     





    <div class="compere">
        <a href="{{ route('compare') }}">
            <button>Compare</button>
        </a>
    </div>

</div>

@endsection
