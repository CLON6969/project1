@php 
    $navItems = App\Models\Nav1::all();
    $logo = App\Models\Logo::first(); // Changed from $icons = ... to $logo = ...
@endphp

<nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>

    @if($logo && $logo->picture)
        <img src="{{ asset('/public/storage/uploads/pics/' . $logo->picture) }}" alt="logo">
    @else
        <img src="{{ asset('/public/uploads/default.png') }}" alt="logo"> {{-- Optional fallback --}}
    @endif

    <ul>
        @foreach ($navItems as $item)
            <li><a href="{{ url($item->name_url) }}">{{ $item->name }}</a></li>
        @endforeach
    </ul>
</nav>
