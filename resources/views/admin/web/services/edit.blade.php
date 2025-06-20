@extends('layouts.admin') {{-- Adjust layout if yours is different --}}

@section('content')
<div class="container py-4">
    <h2>Edit Services Content</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.web.services.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Title 1 --}}
        <div class="mb-3">
            <label>Title 1</label>
            <input type="text" name="title1" class="form-control" value="{{ old('title1', $service->title1) }}" required>
        </div>

        {{-- Title 1 Content --}}
        <div class="mb-3">
            <label>Title 1 Content</label>
            <textarea name="title1_content" class="form-control">{{ old('title1_content', $service->title1_content) }}</textarea>
        </div>

        {{-- Button 1 --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Button 1 Name</label>
                <input type="text" name="button1_name" class="form-control" value="{{ old('button1_name', $service->button1_name) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>Button 1 URL</label>
                <input type="url" name="button1_url" class="form-control" value="{{ old('button1_url', $service->button1_url) }}">
            </div>
        </div>

        {{-- Button 2 --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Button 2 Name</label>
                <input type="text" name="button2_name" class="form-control" value="{{ old('button2_name', $service->button2_name) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>Button 2 URL</label>
                <input type="url" name="button2_url" class="form-control" value="{{ old('button2_url', $service->button2_url) }}">
            </div>
        </div>

        {{-- Title 2 --}}
        <div class="mb-3">
            <label>Title 2</label>
            <input type="text" name="title2" class="form-control" value="{{ old('title2', $service->title2) }}" required>
        </div>

        {{-- Picture 1 --}}
        <div class="mb-3">
            <label>Picture 1</label><br>
            @if($service->picture1)
                <img src="{{ asset('storage/uploads/pics/' . $service->picture1) }}" width="100" class="mb-2">
            @endif
            <input type="file" name="picture1" class="form-control">
        </div>

        {{-- Title 3 --}}
        <div class="mb-3">
            <label>Title 3</label>
            <input type="text" name="title3" class="form-control" value="{{ old('title3', $service->title3) }}">
        </div>

        {{-- Title 3 Content --}}
        <div class="mb-3">
            <label>Title 3 Content</label>
            <textarea name="title3_content" class="form-control">{{ old('title3_content', $service->title3_content) }}</textarea>
        </div>

        {{-- Background Picture --}}
        <div class="mb-3">
            <label>Background Picture</label><br>
            @if($service->background_picture)
                <img src="{{ asset('storage/uploads/pics/' . $service->background_picture) }}" width="100" class="mb-2">
            @endif
            <input type="file" name="background_picture" class="form-control">
        </div>

        {{-- Submit Button --}}
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
