@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Pricing Content</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.web.pricing.update') }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Title 1 --}}
        <div class="mb-3">
            <label for="title1" class="form-label">Title 1</label>
            <input type="text" name="title1" class="form-control" value="{{ old('title1', $pricing->title1 ?? '') }}" required>
        </div>

        {{-- Title 2 --}}
        <div class="mb-3">
            <label for="title2" class="form-label">Title 2</label>
            <input type="text" name="title2" class="form-control" value="{{ old('title2', $pricing->title2 ?? '') }}">
        </div>

        {{-- Title 2 Content --}}
        <div class="mb-3">
            <label for="title2_content" class="form-label">Title 2 Content</label>
            <textarea name="title2_content" class="form-control" rows="3">{{ old('title2_content', $pricing->title2_content ?? '') }}</textarea>
        </div>

        {{-- Title 3 --}}
        <div class="mb-3">
            <label for="title3" class="form-label">Title 3</label>
            <input type="text" name="title3" class="form-control" value="{{ old('title3', $pricing->title3 ?? '') }}">
        </div>

        {{-- Title 4 --}}
        <div class="mb-3">
            <label for="title4" class="form-label">Title 4</label>
            <input type="text" name="title4" class="form-control" value="{{ old('title4', $pricing->title4 ?? '') }}">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
