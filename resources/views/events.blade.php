@extends('layouts.events')

@section('content')

@foreach($events as $event)
<header class="hero">
  


    <img src="{{ asset('uploads/pics/' . $event->background_picture) }}" alt="logo">
    <div class="overlay">
        <div class="overlay-content">
            <h1>{{ $event->title1 }}</h1>
            <p>{{ $event->title1_content }}</p>
        </div>

        <div class="buttons">

            <a href="{{ $event->button1_url }}">
                <button class="btn">{{ $event->button1_name }} →</button>
            </a>


            
            <a href="{{ $event->button2_url }}">
                <button class="btn secondary">{{ $event->button2_name }} →</button>
            </a>
           
        </div>

</header>





<!-- SERVICES SECTION -->
<section class="services">

   
    <div class="services-tittle">
        <h2>{{ $event->title2 }}</h2>
    </div>

    <div class="service-cards">

        @foreach($eventTable as $event)
      

        <div class="card">
            <div class="icon">
                <img src="{{ asset('uploads/pics/' . $event->picture) }}" alt="logo">
                <div class="overlay"></div>

                <div class="overlay-text">
                    <h2>{{ $event->title1 }}</h2>
                    <p>{{ $event->title1_content }}</p>

                    <a href="#">
                        <button class="bottom-btn">{{ $event->country }}// {{ $event->town }}</button>
                    </a>
                </div>
            </div>
        
            <h3>{{ $event->main_tittle }}</h3>
            <p> {{ $event->main_tittle_content }}</p>

            <h4 class="venue-time">{{ $event->day }}, {{ $event->date }} | {{ $event->start_time }} - {{ $event->end_time }}</h4>
 
            <a href="{{ route('events.show', $event->id) }}">{{ $event->button1_name }} →</a>

        </div>


        @endforeach

        
    </div>
</section>

@endforeach
@endsection