@extends('layouts.solutions')

@section('content')


<header class="hero">
    @foreach($solutions as $solution)
    <img src="{{ asset('uploads/pics/100.jpg') }}" alt="logo">
    <div class="overlay">
        <div class="overlay-content">
            <h1>{{ $solution->title1 }}</h1>
            <p>{{ $solution->title1_content }}</p>
        </div>

        <div class="buttons">
            <a href="{{ $solution->button1_url }}"><button class="btn">{{ $solution->button1_name }} →</button></a>
            

            
            <a href="{{ $solution->button2_url }}">
                <button class="btn secondary">{{ $solution->button2_name }} →</button>
            </a>
        </div>
    </div>
</header>

<!-- SERVICES SECTION -->
<section class="services">

   
    <div class="services-tittle">
        <h2>{{ $solution->title2 }}</h2>
    </div>

    <div class="service-cards">


        @foreach($solutionTables->where('category', 'industrial') as $table)
        <div class="card">
        <div class="icon"><i class="fa-solid {{ $table->icon }}"></i></div>

        <h3>{{ $table->title1 }}</h3>
        <p>{{ $table->title1_sub_content }}</p>
        <a href="{{ route('solutions.show', $table->id) }}">More →</a>
        </div>
        @endforeach
        
        

        
    </div>
</section>

</section>

<section class="bottom-section">
<div class="first-bottom-section">
    <div class="image-container">
        <img src="{{ asset('uploads/pics/' . $solution->picture1) }}" alt="logo">
    </div>

</div>
<div class="second-bottom-section">
<h2>{{ $solution->title3 }}</h2>

<p>{{ $solution->title3_content }}</p>


<a href="{{ $solution->button3_url }}">
    <button class="bottom-btn">{{ $solution->button3_name }} →</button>
</a>

</div>
</section>


@endforeach


@endsection