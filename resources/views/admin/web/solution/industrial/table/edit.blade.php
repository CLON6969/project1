@extends('layouts.admin')

@section('content')
<h1>Edit industrial Solution</h1>
<form method="POST" action="{{ route('admin.web.solution.industrial.table.update', $table->id) }}">
    @csrf
    @method('PUT')
    @include('admin.web.solution.partials.form', ['table' => $table])
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection