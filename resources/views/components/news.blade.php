<section id="news" class="@isset($class)
    {{ $class }}
@endisset">
    <a href="{{ $url }}">
        <div class="border-news">
            <div class="border-news__image">
                <img src="{{ $image }}" alt="" class="img-fluid">
            </div>
            <div class="border-news__info">
                <div class="border-news__info--title">
                    {{ $title }}
                </div>
                <div class="border-news__info--teaser">
                    {{ $teaser }}
                </div>
            </div>
        </div>
    </a>
</section>