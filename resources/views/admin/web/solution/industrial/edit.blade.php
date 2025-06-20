@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2>Edit Personal Solution Content</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.web.solution.industrial.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
      

        <div class="mb-3">
            <label>Title 1</label>
            <input type="text" name="title1" class="form-control" value="{{ old('title1', $solution->title1 ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Title 1 Content</label>
            <textarea name="title1_content" class="form-control">{{ old('title1_content', $solution->title1_content ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Button 1 Name</label>
            <input type="text" name="button1_name" class="form-control" value="{{ old('button1_name', $solution->button1_name ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Button 1 URL</label>
            <input type="url" name="button1_url" class="form-control" value="{{ old('button1_url', $solution->button1_url ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Button 2 Name</label>
            <input type="text" name="button2_name" class="form-control" value="{{ old('button2_name', $solution->button2_name ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Button 2 URL</label>
            <input type="url" name="button2_url" class="form-control" value="{{ old('button2_url', $solution->button2_url ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Title 2</label>
            <input type="text" name="title2" class="form-control" value="{{ old('title2', $solution->title2 ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Title 3</label>
            <input type="text" name="title3" class="form-control" value="{{ old('title3', $solution->title3 ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Title 3 Content</label>
            <textarea name="title3_content" class="form-control">{{ old('title3_content', $solution->title3_content ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Button 3 Name</label>
            <input type="text" name="button3_name" class="form-control" value="{{ old('button3_name', $solution->button3_name ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Button 3 URL</label>
            <input type="url" name="button3_url" class="form-control" value="{{ old('button3_url', $solution->button3_url ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Background Picture</label><br>
            @if(!empty($solution->background_picture))
                <img src="{{ asset('storage/uploads/pics/' . $solution->background_picture) }}" width="150" class="mb-2"><br>
            @endif
            <input type="file" name="background_picture" class="form-control">
        </div>

        <div class="mb-3">
            <label>Picture 1</label><br>
            @if(!empty($solution->picture1))
                <img src="{{ asset('storage/uploads/pics/' . $solution->picture1) }}" width="150" class="mb-2"><br>
            @endif
            <input type="file" name="picture1" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
