@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Event</h2>

    <form action="{{ route('admin.web.event.table.update', $table->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.web.event.table.form', ['table' => $table])

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
