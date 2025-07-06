@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Logo</h2>

    <form action="{{ route('admin.web.general.logo.update', $logo->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $logo->title) }}" required>
        </div>

        <div class="mb-3">
            <label>Picture</label><br>
            @if($logo->picture)
                <img src="{{ asset('/public/storage/uploads/pics/' . $logo->picture) }}" width="60" class="mb-2">
            @endif
            <input type="file" name="picture" class="form-control">
        </div>

        <div class="mb-3">
            <label>Picture 2</label><br>
            @if($logo->picture2)
                <img src="{{ asset('/public/storage/uploads/pics/' . $logo->picture2) }}" width="60" class="mb-2">
            @endif
            <input type="file" name="picture2" class="form-control">
        </div>


        <div class="mb-3">
            <label>Background picture</label><br>
            @if($logo->background_picture)
                <img src="{{ asset('/public/storage/uploads/pics/' . $logo->background_picture) }}" width="60" class="mb-2">
            @endif
            <input type="file" name="background_picture" class="form-control">
        </div>


        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
