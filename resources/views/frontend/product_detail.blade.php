@extends('layouts.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/product_category.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/title.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/product_detail.css') }}">
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5fb331c36a73380012578deb&product=inline-share-buttons" async="async"></script>
@endsection

@section('content')
    @include('frontend.components.product.product_main')
    @if($product->productCategory->products->where('publish', 1)->sortByDesc("created_at")->count() > 1)
        @include('frontend.components.product.product_relate')
    @endif
@endsection

@section('js')
    <script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
@endsection

@section('title')
    {{ $product->meta_title ? $product->meta_title : $product->title }}
@endsection
@section('meta_keyword')
    {{ $product->meta_keyword }}
@endsection
@section('meta_desc')
    {{ $product->meta_desc }}
@endsection
@section('og_image')
    {{ asset($product->avatar_image) }}
@endsection
@section('og_image_url')
    {{ asset($product->avatar_image) }}
@endsection
@section('og_image_type')
    image/jpg
@endsection