@extends('layouts.admin')

@section('title', 'Add Refill')

@section('content')
    <form method="POST" action="{{ route('admin.refills.store') }}">
        @include('admin.refills._form')
    </form>
@endsection
