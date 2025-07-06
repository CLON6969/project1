@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">About Table Entries</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.web.about.table.create') }}" class="btn btn-primary mb-3">+ Add New</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Picture</th>
                <th>Title</th>
                <th>Small Text</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $row)
                <tr>
                    <td>
                        @if($row->picture)
                            <img src="{{ asset('/public/storage/uploads/pics/' . $row->picture) }}" alt="pic" width="60">
                        @endif
                    </td>
                    <td>{{ $row->title1 }}</td>
                    <td>{{ $row->title1_small_text }}</td>
                    <td>
                        <a href="{{ route('admin.web.about.table.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('admin.web.about.table.destroy', $row->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this entry?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            @if($records->isEmpty())
                <tr>
                    <td colspan="4" class="text-center">No entries found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
