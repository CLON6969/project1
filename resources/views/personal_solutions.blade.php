@extends('layouts.personal-solutions')

@section('content')


<header class="hero">
    @foreach($personal_solutions as $personal_solution)
    <img src="{{ asset('uploads/pics/100.jpg') }}" alt="logo">
    <div class="overlay">
        <div class="overlay-content">
            <h1>{{ $personal_solution->title1 }}</h1>
            <p>{{ $personal_solution->title1_content }}</p>
        </div>

        <div class="buttons">
            <a href="{{ $personal_solution->button1_url }}"><button class="btn">{{ $personal_solution->button1_name }} →</button></a>
            

            
            <a href="{{ $personal_solution->button2_url }}">
                <button class="btn secondary">{{ $personal_solution->button2_name }} →</button>
            </a>
        </div>
    </div>
</header>

<!-- SERVICES SECTION -->
<section class="services">

   
    <div class="services-tittle">
        <h2>{{ $personal_solution->title2 }}</h2>
    </div>

    <div class="service-cards">


        @foreach($solutionTables->where('category', 'personal') as $table)
        <div class="card">
        <div class="icon"><i class="fa-solid {{ $table->icon }}"></i></div>

        <h3>{{ $table->title1 }}</h3>
        <p>{{ $table->title1_sub_content }}</p>
         <a href="{{ route('personal_solutions.show', $table->id) }}">More →</a>
        </div>
        @endforeach
        
        

        
    </div>
</section>

</section>

<section class="bottom-section">
<div class="first-bottom-section">
    <div class="image-container">
        <img src="{{ asset('uploads/pics/' . $personal_solution->picture1) }}" alt="logo">
    </div>

</div>
<div class="second-bottom-section">
<h2>{{ $personal_solution->title3 }}</h2>

<p>{{ $personal_solution->title3_content }}</p>


<a href="{{ $personal_solution->button3_url }}">
    <button class="bottom-btn">{{ $personal_solution->button3_name }} →</button>
</a>

</div>
</section>
@endforeach
@endsection