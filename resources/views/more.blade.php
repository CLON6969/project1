@extends('layouts.more')

@section('content')


<header class="hero">
    @foreach( $more as  $mores)
    <img src="{{ asset('uploads/pics/' . $mores->background_picture) }}" alt="logo">
    <div class="overlay">
        <div class="overlay-content">
            <h1>{{ $mores->title1 }}</h1>
            <p>{{ $mores->title1_content }}</p>
        </div>


    </div>
</header>

<!-- SERVICES SECTION -->
<section class="services">

    <div class="service-cards">
        @foreach($more_table as $table)
        <div class="card ">
            <div class="icon"><i class="fa-solid {{ $table->icon }}"></i></div>

            <h3>{{ $table->title1 }}</h3>
            <p>{{ $table->title1_sub_content }}</p>
            <a href="{{ $table->button1_url }}">{{ $table->button1_name }} →</a>
        </div>

        <div class="second card">

            <h3>  {{ $table->title2 }} </h3>
            <p>{{ $table->title2_content }}</p>

            <h4>{{ $table->title2_sub_content }}</h4>
        </div>

        @endforeach
        
    </div>
</section>



<section class="bottom-section">


<div class="first-bottom-section">
    <div class="image-container">
        <div class="image-container1">
            <h1>{{ $mores->title2 }}</h1>

            <h4>{{ $mores->title2_content }}</h4>
        </div>


        <div class="buttons">
            <a href="{{ $mores->button1_url }}">
                <button class="btn">{{$mores->button1_name }}→</button>
            </a>


            
            <a href="{{$mores->button2_url }}">
                <button class="btn secondary">{{$mores->button2_name }} →</button>
            </a>
        </div>

    </div>

</div>
<div class="second-bottom-section">
<div class="first-bottom-section">
    <div class="image-container">
        <img src="{{ asset('uploads/pics/' . $mores->picture1) }}" alt="logo">
    </div>

</div>

</div>
</section>
@endforeach
@endsection