@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Footer Titles</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.web.general.footer.titles.create') }}" class="btn btn-primary mb-3">Add New Title</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Sort Order</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($titles as $title)
                <tr>
                    <td>{{ $title->title }}</td>
                    <td>{{ $title->sort_order }}</td>
                    <td>{{ $title->is_active ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('admin.web.general.footer.titles.edit', $title->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.web.general.footer.titles.destroy', $title->id) }}" method="POST" style="display:inline-block">
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