@extends('layouts.home')

@section('content')

<!-- HOME -->
<section class="home">
    <div class="home-logo">
        <img src="{{ asset('uploads/pics/logo2.png') }}" alt="logo">
    </div>

    <div class="home-tittle">
        <div class="clock-container">
            <div class="time-unit">
                <div class="time-labels">
                    <span class="label">M</span>
                    <span class="label">D</span>
                    <span class="label">H</span>
                    <span class="label">M</span>
                    <span class="label">S</span>
                </div>
                <div id="clock"></div>
            </div>
        </div>
    </div>

    @if(isset($homepageContent))
        <img src="{{ asset('uploads/pics/' . $homepageContent->background_picture) }}" alt="background">
    @endif

    <div class="home-logo2">
        <div class="home-logo2-child1">
            <div class="box1"></div>
            <div class="box2"></div>
            <div class="box3"></div>

            <div class="box4">
                <img src="{{ asset('uploads/pics/logo2.png') }}" alt="logo"> 
            </div>

        </div>

    </div>

    <div class="overlay"></div>
</section>

<!-- First Part -->
<section class="mx-auto p-4 first_part">
    <h1 class="text-center first">{{ $homepageContent->title1 ?? '' }}</h1>
    <p class="text-lg text-center mb-4">{{ $homepageContent->title1_content ?? '' }}</p>

    <div class="container">


        <div class="service-cards">


            @php
            $cardStyles = ['card2', 'card3', 'card6']; // Styles for image cards
        @endphp
        
        @foreach ($statements as $index => $statement)
            @php
                $imageCardClass = $cardStyles[$index % count($cardStyles)];
            @endphp
        
            @if (strtolower($statement->id) === '2')
                {{-- Swap: Image first, then Text --}}
                <div class="card {{ $imageCardClass }}">
                    <img src="{{ asset('uploads/pics/' . $statement->background_picture) }}" alt="background picture">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>{{ $statement->title1_sub_content }}</h3>
                        </div>
                    </div>
                </div>
        
                <div class="card card1">
                    <h1>{{ $statement->title1 }}</h1>
                    <p>{{ $statement->title1_main_content }}</p>
                </div>
            @else
                {{-- Normal: Text first, then Image --}}
                <div class="card card1">
                    <h1>{{ $statement->title1 }}</h1>
                    <p>{{ $statement->title1_main_content }}</p>
                </div>
        
                <div class="card {{ $imageCardClass }}">
                    <img src="{{ asset('uploads/pics/' . $statement->background_picture) }}" alt="background picture">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>{{ $statement->title1_sub_content }}</h3>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        

        


        </div>

    </div>


</section>

<!-- Second Part -->
<section class="second_part">
    <div id="about" class="internal_second_section container">
        <h1>{{ $homepageContent->title2 ?? '' }}</h1>
        <h3>{{ $homepageContent->title2 ?? '' }}</h3>
        <p>{{ $homepageContent->title2_content ?? '' }}</p>
    </div>

    @if(isset($homepageContent->picture1))
    <div class="image_container">
        <img src="{{ asset('uploads/pics/' . $homepageContent->picture1) }}" alt="Image">
    </div>
    @endif
</section>

<!-- Third Part -->
<section class="third_part container">
    <div class="frame_container">
        <div class="frame">

        @foreach($homepageContentTable as $table)
            <div class="image4 container">
                <li><a href="{{ $table->url }}">{{ $table->url_name }}</a></li>
                <img src="{{ asset('uploads/pics/' . $table->picture) }}" alt="Image">
            </div>
        @endforeach
           
        </div>
    </div>
</section>

<script>
    const hamburger = document.getElementById('hamburger');
    const navList = document.getElementById('nav-list');
    hamburger.addEventListener('click', () => {
        navList.classList.toggle('active');
    });
</script>

@endsection
