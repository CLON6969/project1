
@extends('layouts.admin')

@section('content')
<h1>Add Personal Solution</h1>
<form method="POST" action="{{ route('admin.web.solution.personal.table.store') }}">
    @csrf
    @include('admin.web.solution.partials.form')
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection