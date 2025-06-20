@extends('layouts.services')

@section('content')


<header class="hero">
    @foreach( $services as  $service)

    <img src="{{ asset('storage/uploads/pics/' . $service->background_picture) }}" alt="background_picture">

    <div class="overlay">
        <h1>{{ $service->title1 }}</h1>
            <p>{{ $service->title1_content }}</p>


            <div class="buttons">
                <a href="{{ $service->button1_url }}"><button class="btn">{{ $service->button1_name }} →</button></a>
                
    
                
                <a href="{{ $service->button2_url }}">
                    <button class="btn secondary">{{ $service->button2_name }} →</button>
                </a>
            </div>
    </div>
</header>

<!-- SERVICES SECTION -->
<section class="services">

   
    <div class="services-tittle">
        <h2>{{ $service->title2 }}</h2>
    </div>

    <div class="service-cards">


        @foreach($services_table as $table)
        <div class="card">
        <div class="icon" style=""><i class="{{ $table->icon }}"></i></div>

        <h3>{{ $table->title1 }}</h3>
        <p>{{ $table->title1_sub_content }}</p>
        <a href="{{ route('services.show', $table->id) }}">{{ $table->button1_name }} →</a>

        </div>
        @endforeach





        
    </div>
</section>



<section class="bottom-section">

    <div class="second-bottom-section">
        <h2>{{ $service->title3 }}</h2>
    
        <p>{{ $service->title3_content }}</p>

    

    </div>

    <div class="first-bottom-section">
        <div class="image-container">
            <img src="{{ asset('storage/uploads/pics/' . $service->picture1) }}" alt="picture">
        </div>
    
    </div>
    </section>

    @endforeach
@endsection