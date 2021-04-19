@extends('layouts.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/product_category.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/title.css') }}">
@endsection

@section('content')
    @include('frontend.components.home.product_category')
@endsection

@section('js')

@endsection