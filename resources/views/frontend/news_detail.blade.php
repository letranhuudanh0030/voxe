@extends('layouts.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/title.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/news.css') }}">
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5fb331c36a73380012578deb&product=inline-share-buttons" async="async"></script>
@endsection

@section('content')
    @include('frontend.components.news.news_main')

    @if(count($articles) > 1 && $articles->first()->artileCategory->page_type != 10)
        @include('frontend.components.news.news_relate')
    @endif
@endsection

@section('js')
    
@endsection

@section('title')
    {{ $article_single->meta_title ? $article_single->meta_title : $article_single->title }}
@endsection
@section('meta_keyword')
    {{ $article_single->meta_keyword }}
@endsection
@section('meta_desc')
    {{ $article_single->meta_desc }}
@endsection
@section('og_image')
    {{ asset($article_single->avatar_image) }}
@endsection
@section('og_image_url')
    {{ asset($article_single->avatar_image) }}
@endsection
@section('og_image_type')
    image/jpg
@endsection