@extends('layouts.pricing')

@section('content')

{{-- PRICING PAGE HEADER --}}
@foreach ($pricing as $pricing_page)
    <div class="home-title">
        <button>{{ $pricing_page->tittle1 }} <i class="fas fa-volleyball-ball"></i></button>
        <h1>{{ $pricing_page->tittle2 }}</h1>
        <p>{{ $pricing_page->tittle2_content }}</p>
        <div class="overlap-buttons">
            <button>{{ $pricing_page->tittle3 }} <i class="fas fa-volleyball-ball"></i></button>
            <button>{{ $pricing_page->tittle4 }} <i class="fas fa-volleyball-ball"></i></button>
        </div>
    </div>
@endforeach

{{-- INITIAL 3 PACKAGES --}}
<div id="packages-wrapper">
    @foreach ($packages->take(3) as $package)
        @include('components.package', ['package' => $package])
    @endforeach
</div>

{{-- LOAD MORE BUTTON --}}
@if ($packages->count() > 3)
    <div style="text-align: center; margin-top: 20px;">
        <button id="load-more-btn" data-offset="3" class="load-more">Load More...</button>
    </div>
@endif

{{-- AJAX SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const loadMoreBtn = document.getElementById('load-more-btn');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function () {
            const offset = parseInt(this.getAttribute('data-offset'));

            fetch(`/load-more-packages?offset=${offset}`)
                .then(response => response.text())
                .then(html => {
                    if (html.trim() === '') {
                        this.style.display = 'none';
                    } else {
                        document.getElementById('packages-wrapper').insertAdjacentHTML('beforeend', html);
                        this.setAttribute('data-offset', offset + 2);
                    }
                })
                .catch(error => console.error('Error loading more packages:', error));
        });
    }
});
</script>

@endsection
