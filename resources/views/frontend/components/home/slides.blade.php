<section id="slideshow">
    <div class="nb-next-pre d-none d-xl-block"><i class="fa fa-arrow-left"></i></div>
        <div class="slide-show row ">
            @foreach ($slides as $slide)
                <div class="slide-content">
                    <img src="{{ asset($slide->avatar_image) }}" alt="" title="{{ $slide->title }}" class="img-fluid">
                    <div class="content d-none">
                        <h3>{{ $slide->meta_title }}</h3>
                        
                        @php
                            $string = $slide->title;
                            $stringArr = explode(' ', $string);
                            $percent_inc = 500;
                        @endphp
                        
                        <h1>
                            @foreach($stringArr as $word)
                                <span style="animation-delay:{{$percent_inc}}ms; -moz-animation-delay:{{$percent_inc}}ms; -webkit-animation-delay:{{$percent_inc}}ms; ">{{$word}}</span>
                                @php
                                    $percent_inc += 350
                                @endphp
                            @endforeach
                        </h1>
                        <p>{{ $slide->meta_desc }}</p>
                        <a href="{{ $slide->link }}">Xem thêm</a>
                    </div>
                </div>
            @endforeach
            
        </div>
    <div class="nb-next-next d-none d-xl-block"><i class="fa fa-arrow-right"></i></div>
</section>
<script defer>
    $(function(){
        $('.slide-show').slick({

            // dots: true,
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear',
            arrows: true,
            autoplay: true,
            autoplaySpeed: 5000,
            prevArrow: $('.nb-next-pre'),
            nextArrow: $('.nb-next-next'),
            responsive: [
                {
                breakpoint: 1024,
                settings: {
                    infinite: false,
                    dots: false,
                    arrows: false
                }
                },
                {
                breakpoint: 600,
                settings: {
                    infinite: false,
                    dots: false,
                    arrows: false
                }
                },
                {
                breakpoint: 480,
                settings: {
                    infinite: false,
                    dots: false,
                    arrows: false
                }
                }
            ]
        });
    })
</script>
