@extends('layouts.app')

@section('title', config('app.name') . ' — Smell Good. Feel Confident.')
@section('meta_description', 'Discover affordable fragrances with premium character, designed for every moment.')

@section('content')
    @include('home.hero')
    @include('home.products', ['featuredProducts' => $featuredProducts])
    @include('home.story')
    @include('home.refill-preview', ['refillPreview' => $refillPreview])
    @include('home.ingredients', ['signatureNotes' => $signatureNotes])
    @include('home.refill-service')
    @include('home.cta')
@endsection
