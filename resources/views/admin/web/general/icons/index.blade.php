@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Icons</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.web.general.icons.create') }}" class="btn btn-primary mb-3">Add Icon</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Picture 1</th>
                <th>Picture 2</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($icons as $icon)
                <tr>
                    <td>{{ $icon->title }}</td>
                    <td>
                        @if($icon->picture)
                            <img src="{{ asset('storage/uploads/pics/' . $icon->picture) }}" width="50">
                        @endif
                    </td>
                    <td>
                        @if($icon->picture2)
                            <img src="{{ asset('storage/uploads/pics/' . $icon->picture2) }}" width="50">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.web.general.icons.edit', $icon->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.web.general.icons.destroy', $icon->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection