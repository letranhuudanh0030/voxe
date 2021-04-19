<section id="news_main">
    <x-title>
        <x-slot name='title'>{{ $title_page }}</x-slot>
        <x-slot name='class'>col-12 col-lg-11 mx-auto</x-slot>
    </x-title>
    <div class="row">
        <div class="col-12 col-lg-11 mx-auto">
            <div class="content">
                {!! $article_single->content !!}
            </div>
            
            <!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons my-4"></div><!-- ShareThis END -->
        </div>
    </div>
</section>