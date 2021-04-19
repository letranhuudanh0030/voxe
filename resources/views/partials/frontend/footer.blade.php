<section id="footer">
    <div class="container-fluid">
        <div class="row footer--bg footer--color">
            <div class="col-12 col-xl-11 mx-auto">
                <div class="row footer">
                    <div class="col-12 col-lg-6">
                        <h3 class="footer__title">thông tin công ty</h3>
                        <div>
                            {!! $configContact->footer !!}
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <h3 class="footer__title">Chính sách</h3>
                        <ul>
                            @foreach ($articleCate->where('page_type', 10)->first()->article->where('publish', 1) as $policy)
                                <li>
                                    <a href="{{ route('news', ['slug' => $policy->slug, 'id' => $policy->id]) }}">{{ $policy->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="nb-social">
                            @foreach ($socials as $social)
                                <a href="{{ $social->link }}" target="_blank"><i class="{{ $social->icon }}"></i></a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <h3 class="footer__title">Liên kết</h3>
                        <div class="fb-page" data-href="{{ $socials->where('name', 'facebook')->first()->link }}" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row copyright-bg copyright-color">
            <div class="col-12 col-lg-11 mx-auto">
                <div class="copyright text-center">
                    Copyright © {{ $configGeneral->copyright }}. Design by <a href="https://www.hiephoidoanhnghiepvietnam.com/" target="_blank">NAM BỘ VN</a>. Trực tuyến: {{ (counter()['online'] + 3) }}, Hôm nay: {{ (counter()['today'] + 35) }}, Tổng cộng: {{ (counter()['total'] + 2455) }}
                </div>
            </div>
        </div>
    </div>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0" nonce="1h2JZQrs"></script>
</section>
<a href="#" id="back-to-top" title="Back to top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
<script defer>
    if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}
</script>