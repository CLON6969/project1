@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit More Table Item</h2>

    <form action="{{ route('admin.web.more.table.update', $table->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.web.more.table.partials.form', ['table' => $table])
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
