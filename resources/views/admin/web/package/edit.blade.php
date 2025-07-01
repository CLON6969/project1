@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Package</h1>
    @include('admin.web.package.partials.form', ['package' => $package])
</div>
@endsection

