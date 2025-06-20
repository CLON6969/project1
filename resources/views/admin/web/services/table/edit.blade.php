@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2>Edit Service Table Entry</h2>

    <form method="POST" action="{{ route('admin.web.services.table.update', $table->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Icon (class name)</label>
            <input type="text" name="icon" class="form-control" value="{{ $table->icon }}" required>
            <small>Current preview:    <i class="fa-solid {{ $table->icon }}"></i></small>
        </div>

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title1" class="form-control" value="{{ old('title1', $table->title1) }}" required>
        </div>

        <div class="mb-3">
            <label>Sub Content</label>
            <textarea name="title1_sub_content" class="form-control">{{ old('title1_sub_content', $table->title1_sub_content) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Button Name</label>
            <input type="text" name="button1_name" class="form-control" value="{{ old('button1_name', $table->button1_name) }}">
        </div>

        <div class="mb-3">
            <label>Button URL</label>
            <input type="url" name="button1_url" class="form-control" value="{{ old('button1_url', $table->button1_url) }}">
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category" class="form-control">
                <option value="">-- Select Category --</option>
                @php $categories = ['General', 'Marketing', 'Technology', 'Support']; @endphp
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ old('category', $table->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
