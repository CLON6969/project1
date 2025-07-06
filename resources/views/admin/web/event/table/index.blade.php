@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Event List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.web.event.table.create') }}" class="btn btn-primary mb-3">+ Add New Event</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Picture</th>
                <th>Title</th>
                <th>Country</th>
                <th>Town</th>
                <th>Date</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($records as $item)
                <tr>
                    <td>
                        @if($item->picture)
                            <img src="{{ asset('/public/storage/uploads/events/' . $item->picture) }}" width="80">
                        @endif
                    </td>
                    <td>{{ $item->title1 }}</td>
                    <td>{{ $item->country }}</td>
                    <td>{{ $item->town }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->start_time }} - {{ $item->end_time }}</td>
                    <td>
                        <a href="{{ route('admin.web.event.table.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.web.event.table.destroy', $item->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this event?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">No events found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
