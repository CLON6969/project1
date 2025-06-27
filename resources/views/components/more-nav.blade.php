@php 
    $navItems = App\Models\MoreNav::all();
    $icon = App\Models\Logo::first(); // Changed from $icons = ... to $icon = ...
@endphp

<nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>

    @if($icon && $icon->picture)
        <img src="{{ asset('storage/uploads/pics/' . $icon->picture) }}" alt="logo">
    @else
        <img src="{{ asset('uploads/default.png') }}" alt="logo"> {{-- Optional fallback --}}
    @endif

    <ul>
        @foreach ($navItems as $item)
            <li><a href="{{ url($item->name_url) }}">{{ $item->name }}</a></li>
        @endforeach
    </ul>
</nav>
