@auth
    @if(auth()->user()->role_id === 1)
        <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
    @elseif(auth()->user()->role_id === 2)
        <a href="{{ route('staff.dashboard') }}">Staff Dashboard</a>
    @elseif(auth()->user()->role_id === 3)
        <a href="{{ route('user.dashboard') }}">User Dashboard</a>
    @endif
@endauth
