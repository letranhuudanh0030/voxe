<section id="news_home">
    <x-title>
        <x-slot name="title">Tin tức</x-slot>
        <x-slot name='class'>col-12 col-xl-11 mx-auto</x-slot>
    </x-title>
    <div class="row">
        <div class="col-12 col-xl-11 mx-auto">
            <div class="news">
                <div class="row">
                    @forelse ($news_category->article->where('publish', 1)->where('highlight', 1) as $news)
                        <div class="col-6 col-lg-3">
                            <x-news>
                                <x-slot name='title'>{{ $news->title }}</x-slot>
                                <x-slot name='image'>{{ $news->avatar_image ? asset($news->avatar_image) : asset('/uploads/noimage.jpg') }}</x-slot>
                                <x-slot name='teaser'>{!! $news->short_desc !!}</x-slot>
                                <x-slot name='url'>{{ ArticleDetailRoute($news) }}</x-slot>
                            </x-news>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center">@lang('text.not_found')</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>