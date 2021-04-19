@extends('layouts.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/title.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/product_category.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/news.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.fancybox.min.css') }}">
@endsection

@section('content')
    @include('frontend.components.home.slides')
    @include('frontend.components.home.banner_categories')
    @include('frontend.components.home.product_category')
    @include('frontend.components.home.news_home')
    @include('frontend.components.home.video_home')
    @include('frontend.components.home.service_home')
@endsection

@section('js')
    <script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
@endsection

@section('title')
    {{ $configGeneral->meta_title }}
@endsection
@section('meta_keyword')
    {{ $configGeneral->meta_keyword }}
@endsection
@section('meta_desc')
    {{ $configGeneral->meta_desc }}
@endsection
