@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Social Links</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.web.general.socials.create') }}" class="btn btn-primary mb-3">Add New Social</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Icon</th>
                <th>URL</th>
                <th>Sort Order</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($socials as $social)
                <tr>
                    <td>{{ $social->icon }}</td>
                    <td>{{ $social->name_url }}</td>
                    <td>{{ $social->sort_order }}</td>
                    <td>{{ $social->is_active ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('admin.web.general.socials.edit', $social->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.web.general.socials.destroy', $social->id) }}" method="POST" style="display:inline-block">
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