@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>More Table List</h2>
    <a href="{{ route('admin.web.more.table.create') }}" class="btn btn-primary mb-3">Add New</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Icon</th>
                <th>Title 1</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
            <tr>
                <td><i class="{{ $record->icon }}"></i> <small>{{ $record->icon }}</small></td>
                <td>{{ $record->title1 }}</td>
                <td>{{ $record->title1 }}</td>
                <td>
                    <a href="{{ route('admin.web.more.table.edit', $record->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('admin.web.more.table.destroy', $record->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this record?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
