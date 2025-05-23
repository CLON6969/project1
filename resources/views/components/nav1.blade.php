@php
    $navItems = App\Models\Nav1::all();
@endphp

<nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
   <img src="{{ asset('uploads/pics/logo1.png') }}" alt="logo">
    <ul>
        @foreach ($navItems as $item)
            <li><a href="{{ url($item->name_url) }}">{{ $item->name }}</a></li>
        @endforeach
    </ul>
</nav>
