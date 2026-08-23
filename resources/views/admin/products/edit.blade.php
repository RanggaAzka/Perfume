@extends('layouts.admin')

@section('title', 'Edit ' . $product->name)

@section('content')
    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="max-w-5xl">
        @include('admin.products._form')
    </form>
@endsection
