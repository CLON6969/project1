@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit About Section</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.web.about.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title 1</label>
            <input type="text" name="title1" class="form-control" value="{{ old('title1', $about->title1 ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Title 1 Content</label>
            <textarea name="title1_content" class="form-control">{{ old('title1_content', $about->title1_content ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Title 2</label>
            <input type="text" name="title2" class="form-control" value="{{ old('title2', $about->title2 ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Title 2 Content</label>
            <textarea name="title2_content" class="form-control">{{ old('title2_content', $about->title2_content ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Button 1 Name</label>
            <input type="text" name="button1_name" class="form-control" value="{{ old('button1_name', $about->button1_name ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Button 1 URL</label>
            <input type="url" name="button1_url" class="form-control" value="{{ old('button1_url', $about->button1_url ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Button 2 Name</label>
            <input type="text" name="button2_name" class="form-control" value="{{ old('button2_name', $about->button2_name ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Button 2 URL</label>
            <input type="url" name="button2_url" class="form-control" value="{{ old('button2_url', $about->button2_url ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Title 3</label>
            <input type="text" name="title3" class="form-control" value="{{ old('title3', $about->title3 ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Title 3 Content</label>
            <textarea name="title3_content" class="form-control">{{ old('title3_content', $about->title3_content ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Title 4</label>
            <input type="text" name="title4" class="form-control" value="{{ old('title4', $about->title4 ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Title 4 Content</label>
            <textarea name="title4_content" class="form-control">{{ old('title4_content', $about->title4_content ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Title 5</label>
            <input type="text" name="title5" class="form-control" value="{{ old('title5', $about->title5 ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Title 6</label>
            <input type="text" name="title6" class="form-control" value="{{ old('title6', $about->title6 ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Background Picture</label><br>
            @if(!empty($about->background_picture))
                <img src="{{ asset('/public/storage/uploads/pics/' . $about->background_picture) }}" alt="Background Picture" class="mb-2" width="150">
            @endif
            <input type="file" name="background_picture" class="form-control">
        </div>

        <div class="mb-3">
            <label>Background Picture 2</label><br>
            @if(!empty($about->background_picture2))
                <img src="{{ asset('/public/storage/uploads/pics/' . $about->background_picture2) }}" alt="Background Picture 2" class="mb-2" width="150">
            @endif
            <input type="file" name="background_picture2" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
