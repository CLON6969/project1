@php 
    $logo = App\Models\Logo::first(); // Changed from $icons = ... to $logo = ...
@endphp



<div class="package-container">
    <div class="tittle">
        <h1>{{ $package->package_tittle }}</h1>
        <p>{{ $package->statement }}</p>
        <ul>
            <li><strong>{{ $package->tittle1 }}:</strong> {{ $package->tittle1_content }}</li>
            <li><strong>{{ $package->tittle2 }}:</strong> {{ $package->tittle2_content }}</li>
            <li><strong>{{ $package->tittle3 }}:</strong> {{ $package->tittle3_content }}</li>
            <li><strong>{{ $package->tittle4 }}:</strong> {{ $package->tittle4_content }}</li>
            <li><strong>{{ $package->tittle5 }}:</strong> {{ $package->tittle5_content }}</li>
        </ul>
    </div>

    <div class="plans-container">
        @foreach ($package->plans as $plan)
        <div class="plan {{ $loop->index == 0 ? 'first' : ($loop->index == 1 ? 'second' : 'third') }}">
            <div class="plan-header"> 
                <img src="{{ asset('/public/storage/uploads/pics/' . $logo->picture2) }}" alt="logo"> 
                <div class="plan-header-tittle">{{ $plan->plan_tittle }}</div> 
            </div>
            <div class="price">
                <span class="discount">100% Maintenance Fee (Annual)</span><br> 
                {{ $plan->currency }} {{ number_format($plan->amount, 2) }}
            </div>
            <div class="subtext">{{ $plan->content1 }}</div>
            <div class="free-header">Free hosting</div>
            
<form method="POST" action="{{ route('subscription.apply') }}">
    @csrf
    <input type="hidden" name="package_id" value="{{ $package->id }}">
    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
    <button type="submit" class="choice">choose</button>
</form>



            
            <ul class="features">
                @foreach ($plan->features as $feature)
                <li>{{ $feature->name }}</li>
                @endforeach
            </ul>
            <div class="read_more">
                <a href="{{ route('plan.details', $plan->id) }}" class="button">Read more</a>
            </div>
        </div>
        @endforeach
    </div>
</div>


