@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Icon</h2>

    <form action="{{ route('admin.web.general.icons.update', $icon->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $icon->title) }}" required>
        </div>

        <div class="mb-3">
            <label>Picture 1</label><br>
            @if($icon->picture)
                <img src="{{ asset('storage/uploads/pics/' . $icon->picture) }}" width="80" class="mb-2">
            @endif
            <input type="file" name="picture" class="form-control">
        </div>

        <div class="mb-3">
            <label>Picture 2</label><br>
            @if($icon->picture2)
                <img src="{{ asset('storage/uploads/pics/' . $icon->picture2) }}" width="80" class="mb-2">
            @endif
            <input type="file" name="picture2" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
