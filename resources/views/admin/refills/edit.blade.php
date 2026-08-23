@extends('layouts.admin')

@section('title', 'Edit ' . $refill->name)

@section('content')
    <form method="POST" action="{{ route('admin.refills.update', $refill) }}">
        @include('admin.refills._form')
    </form>
@endsection
