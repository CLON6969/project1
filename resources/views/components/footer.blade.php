@php
    // Get footer titles with their items
    $footerData = App\Models\FooterTitle::with(['items' => function($query) {
        $query->active()->ordered();
    }])->active()->ordered()->get();
    
    // Get active social icons ordered by sort_order
    $socialIcons = App\Models\Social::where('is_active', true)
                                  ->orderBy('sort_order')
                                  ->get();
@endphp

<section class="last_part">
    <div class="content_container">
        <!-- Footer Links Section -->
        @foreach ($footerData as $title)
        <div class="box_container4">
            <ul>
                <li class="tittles">{{ $title->title }}</li>
               
                @foreach ($title->items as $item)
                <li class="items">
                    <a href="{{ $item->url }}">{{ $item->text }}</a>
                </li>
                @endforeach
            </ul>
        </div>
        @endforeach

        <!-- Social Icons Section (Dynamic from database) -->
        <div class="icons">
            @foreach ($socialIcons as $social)
            <li class="{{ Str::slug($social->icon) }} box">
                <a href="{{ $social->name_url }}" target="_blank">
                    <i class="fa-brands {{ $social->icon }}"></i>
                </a>
            </li>
            @endforeach
        </div>
    </div>
</section>

<footer>
    <p class="mb-0">&copy; <span id="current-year"></span> Powered by Kumoyo Technologies.</p>
</footer>

<script>
    // Get the current year
    const currentYear = new Date().getFullYear();
    // Set the current year in the footer
    document.getElementById('current-year').textContent = currentYear;
</script>