@extends('layouts.app')

@section('title', config('app.name') . ' — Smell Good, Feel Confident.')
@section('meta_description', 'Discover affordable luxury fragrances with premium character by Perfu.me, designed for every moment.')

@section('content')
    @include('home.hero')
    @include('home.products', ['featuredProducts' => $featuredProducts])
    @include('home.refill-preview', ['refillPreview' => $refillPreview])
    @include('home.newsletter')
@endsection
