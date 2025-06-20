@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2>All Service Table Entries</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.web.services.table.create') }}" class="btn btn-primary mb-3">Add New</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Icon</th>
                <th>Title</th>
               
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $record)
            <tr>
                 <td><i class="{{ $record->icon }}"></i> <small>{{ $record->icon }}</small></td>
                <td>{{ $record->title1 }}</td>
                <td>
                    <a href="{{ route('admin.web.services.table.edit', $record->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.web.services.table.destroy', $record->id) }}" method="POST" style="display:inline;">
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
