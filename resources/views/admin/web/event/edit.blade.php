@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Event Content</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.web.event.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title 1</label>
            <input type="text" name="title1" class="form-control" value="{{ old('title1', $event->title1 ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Title 1 Content</label>
            <textarea name="title1_content" class="form-control">{{ old('title1_content', $event->title1_content ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Button 1 Name</label>
            <input type="text" name="button1_name" class="form-control" value="{{ old('button1_name', $event->button1_name ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Button 1 URL</label>
            <input type="url" name="button1_url" class="form-control" value="{{ old('button1_url', $event->button1_url ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Button 2 Name</label>
            <input type="text" name="button2_name" class="form-control" value="{{ old('button2_name', $event->button2_name ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Button 2 URL</label>
            <input type="url" name="button2_url" class="form-control" value="{{ old('button2_url', $event->button2_url ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Title 2</label>
            <input type="text" name="title2" class="form-control" value="{{ old('title2', $event->title2 ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Background Picture</label><br>
            @if(!empty($event->background_picture))
                <img src="{{ asset('/public/storage/uploads/pics/' . $event->background_picture) }}" width="100"><br>
            @endif
            <input type="file" name="background_picture" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
