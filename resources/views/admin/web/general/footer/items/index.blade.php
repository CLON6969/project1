@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Footer Items</h2>
    <a href="{{ route('admin.web.general.footer.items.create') }}" class="btn btn-primary mb-3">Add New Item</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Text</th>
                <th>URL</th>
                <th>Title</th>
                <th>Order</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->text }}</td>
                <td><a href="{{ $item->full_url }}" target="_blank">{{ $item->url }}</a></td>
                <td>{{ $item->title->title ?? 'N/A' }}</td>
                <td>{{ $item->sort_order }}</td>
                <td>{{ $item->is_active ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('admin.web.general.footer.items.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.web.general.footer.items.destroy', $item) }}" method="POST" style="display:inline-block">
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