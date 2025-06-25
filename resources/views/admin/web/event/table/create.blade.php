@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Create Event</h2>

    <form action="{{ route('admin.web.event.table.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('admin.web.event.table.form')

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
