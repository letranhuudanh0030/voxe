<section id="news_relate">
    <x-title>
        <x-slot name='title'>Tin tức liên quan</x-slot>
        <x-slot name='class'>col-12 col-lg-11 mx-auto</x-slot>
    </x-title>
    <div class="row">
        <div class="col-12 col-lg-11 mx-auto">
            <div class="news mb-4">
                <div class="row">
                    @forelse ($articles as $article)
                        @if ($article->id != $article_single->id)
                            <div class="col-6 col-md-4 col-lg-3 mt-4 px-1">
                                <x-news>
                                    <x-slot name='title'>{{ $article->title }}</x-slot>
                                    <x-slot name='image'>{{ $article->avatar_image ? asset($article->avatar_image) : asset('/uploads/noimage.jpg') }}</x-slot>
                                    <x-slot name='teaser'>{!! $article->short_desc !!}</x-slot>
                                    <x-slot name='url'>{{ ArticleDetailRoute($article) }}</x-slot>
                                </x-news>
                            </div>
                        @endif
                    @empty
                        
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>