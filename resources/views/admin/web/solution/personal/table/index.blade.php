@extends('layouts.admin')

@section('content')
<h1>Personal Solutions</h1>
<a href="{{ route('admin.web.solution.personal.table.create') }}" class="btn btn-primary mb-3">Add New</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Icon</th>
            <th>Title</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $item)
        <tr>
            <td>{{ $item->icon }}</td>
            <td>{{ $item->title1 }}</td>
            <td>
                <a href="{{ route('admin.web.solution.personal.table.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.web.solution.personal.table.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
