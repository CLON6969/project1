@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Create Logo</h2>

    <form action="{{ route('admin.web.general.logo.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Picture</label>
            <input type="file" name="picture" class="form-control">
        </div>

        <div class="mb-3">
            <label>Picture 2</label>
            <input type="file" name="picture2" class="form-control">
        </div>

        <div class="mb-3">
            <label>Background picture</label>
            <input type="file" name="background_picture" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
