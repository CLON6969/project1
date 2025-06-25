@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Create More Table Item</h2>

    <form action="{{ route('admin.web.more.table.store') }}" method="POST">
        @csrf
        @include('admin.web.more.table.partials.form')
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection
