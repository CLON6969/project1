@extends('layouts.learn_more_events')


@section('content')

<link rel="stylesheet" href="{{ asset('css/event-details.css') }}">

<div class="event-detail-container">
    <!-- Hero Section -->
    <div class="event-hero">
        <img src="{{ asset('uploads/pics/' . $event->picture) }}" alt="Event Image">
        <div class="overlay">
            <h1 class="event-title">{{ $event->title1 }}</h1>
        </div>
    </div>

    <!-- Details Section -->
    <div class="event-content">
        <p class="event-intro">{{ $event->title1_content }}</p>

        <h2 class="event-main-title">{{ $event->main_tittle }}</h2>
        <p class="event-description">{{ $event->main_tittle_content }}</p>

        <div class="event-info-grid">
            <div class="info-box">
                <h4><i class="fas fa-location-dot"></i>  Location</h4>
                <p>{{ $event->town }}, {{ $event->country }}</p>
            </div>
            <div class="info-box">
                <h4><i class="fas fa-calendar-day"></i>  Date & Time</h4>
                <p>{{ $event->day }}, {{ $event->date }} | {{ $event->start_time }} - {{ $event->end_time }}</p>
            </div>
        </div>

        <div class="event-btn">
           
            <a href="{{ route('events.index') }}" class="read-more-btn">
               <i class="fas fa-arrow-left"> </i> Back to all events
            </a>
        </div>
    </div>
</div>

@endsection
