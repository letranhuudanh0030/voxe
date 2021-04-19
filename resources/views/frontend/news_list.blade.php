@extends('layouts.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/title.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/news.css') }}">
@endsection

@section('content')
    <section id="news">
        <x-title>
            <x-slot name='title'>{{ $title_page }}</x-slot>
            <x-slot name='class'>col-12 col-lg-11 mx-auto</x-slot>
        </x-title>
        
        <div class="row mb-4">
            <div class="col-12 col-xl-11 mx-auto">
                <div class="row">
                    @forelse ($news_category->where('page_type', $category_menu->page_type)->first()->getArticlesPublish() as $news )
                        <div class="col-6 col-lg-3 mt-4 px-1">
                            <x-news>
                                <x-slot name='title'>{{ $news->title }}</x-slot>
                                <x-slot name='image'>{{ $news->avatar_image ? asset($news->avatar_image) : asset('/uploads/noimage.jpg') }}</x-slot>
                                <x-slot name='teaser'>{!! $news->short_desc !!}</x-slot>
                                <x-slot name='url'>{{ ArticleDetailRoute($news) }}</x-slot>
                            </x-news>
                        </div>
                    @empty

                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection


@section('js')
    
@endsection

@section('title')
    {{ $news_category->where('page_type', $category_menu->page_type)->first()->meta_title }}
@endsection
@section('meta_keyword')
    {{ $news_category->where('page_type', $category_menu->page_type)->first()->meta_keyword }}
@endsection
@section('meta_desc')
    {{ $news_category->where('page_type', $category_menu->page_type)->first()->meta_desc }}
@endsection