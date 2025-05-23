@extends('layouts.learn_more_solutions')


@section('content')

<div class="container">

    <div class="container_child">

        
    <div class="icon-box">
        <i class="fa-solid {{ $table->icon }}"></i>
    </div>

    <h1>{{ $table->title1 }}</h1>
    <p>{{ $table->title1_sub_content }}</p>

    <div class="section-title">More Information</div>
    <p>{{ $table->content }}</p>


    <div class="info-row">
         {{ $table->content }}
    </div>



    <br><br>
    <a href="{{ route('solutions.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Back to all solutions
    </a>

    </div>
</div>

@endsection
