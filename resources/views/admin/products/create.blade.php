@extends('layouts.admin')

@section('title', 'New Product')

@section('content')
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="max-w-5xl">
        @include('admin.products._form')
    </form>
@endsection
