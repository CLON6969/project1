@extends('layouts.learn_more_services')

<style></style>

@section('content')

<div class="container">
    <div class="container_child">

    <div class="icon-box">
        <i class="fa-solid {{ $service->icon }}"></i>
    </div>

    <h1>{{ $service->title1 }}</h1>
    <p>{{ $service->title1_sub_content }}</p>

    <div class="section-title">More Information</div>
    <p>{{ $service->content }}</p>


    <br>
    <a href="{{ route('services.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Back to all services
    </a>

    </div>

</div>
@endsection
