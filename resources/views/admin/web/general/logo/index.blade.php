@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Logo List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.web.general.logo.create') }}" class="btn btn-primary mb-3">Add New Logo</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Picture 1</th>
                <th>Picture 2</th>
                <th>background picture</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logo as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td><img src="{{ asset('/public/storage/uploads/pics/' . $item->picture) }}" width="50"></td>
                    <td><img src="{{ asset('/public/storage/uploads/pics/' . $item->picture2) }}" width="50"></td>
                    <td><img src="{{ asset('/public/storage/uploads/pics/' . $item->background_picture) }}" width="50"></td>
                    <td>
                        <a href="{{ route('admin.web.general.logo.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.web.general.logo.destroy', $item->id) }}" method="POST" style="display:inline-block">
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
