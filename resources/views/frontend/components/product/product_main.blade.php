<section id="product_main">
    <!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons mt-4"></div><!-- ShareThis END -->
    <div class="product-detail mt-4">
        <div class="row">
            <div class="col-12 col-lg-11 mx-auto">
                <div class="row">
                    <div class="col-12 col-lg-5">
                        <div class="product-slider">
                            <div class="product-slider__show">
                                @if ($product->images)
                                    @foreach (explode(',', $product->images) as $key => $img)
                                        <a href="{{ asset($img) }}" data-fancybox="gallery" data-caption="{{ $product->title ."-". $key}}">
                                            <img src="{{ asset($img) }}" alt="{{ $product->title ."-". $key}}" title="{{ $product->title ."-". $key}}" class="img-fluid" width="100%">
                                        </a>
                                    @endforeach
                                @else
                                    <a href="{{ asset($product->avatar_image) }}" data-fancybox="gallery" data-caption="{{ $product->title }}">
                                        <img src="{{ asset($product->avatar_image) }}" title="{{ $product->title }}" alt="{{ $product->title }}" width="100%">
                                    </a>
                                @endif
                            </div>
                            <div class="product-slider__list">
                                @if ($product->images)
                                    @foreach (explode(',', $product->images) as $key => $img)
                                        <div class="img-item">
                                            <img src="{{ asset($img) }}" alt="{{ $product->title ."-". $key}}" class="img-fluid" title="{{ $product->title ."-". $key}}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="col-12 col-lg-7">
                        <div class="product-info">
                            <h3 class="product-info__title">
                                {{ $product->title }}
                            </h3>
                            @foreach($product->size as $size)
                                <p><strong>Kích thước: </strong>{{ $size->title }}</p>
                            @endforeach
                            <div class="prodcut-info__intro">
                                {!! $product->short_desc !!}
                            </div>
                            <p class="product-info__price">
                                Giá: <span>{{ $product->price == 0 ? "Liên hệ" : number_format($product->price, 0, ',', '.') . " VNĐ" }}</span>
                            </p>
                            {{-- <div class="product-info__quantity">
                                <button class="minus-btn" type="button" name="button">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                </button>
                                <input type="text" name="qty" value="1" class="input-qty">
                                <button class="plus-btn" type="button" name="button">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div> --}}

                            <div class="product-info__action mt-3 mb-3">
                                <a href="tel:{{ $configGeneral->phone }}" class="hotline">Hotline: {{ $configGeneral->phone }}</a>
                                <a href="{{ route('menu', ['slug' => App\ArticleCategory::select('slug')->where('page_type', 1)->first()->slug]) }}" class="contact">Liên hệ</a>
                            </div>
                        </div>
                        <div class="image-promotion">
                            <img class="img-fluid" src="{{ asset($display->banner_page) }}" />
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <h2 class="text-danger text-uppercase font-weight-bold">Nội dung</h2>
                        <div class="product-desc mt-3">
                            {!! $product->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script defer>
        $(function(){

            $('.minus-btn').on('click', function(e) {
                e.preventDefault();
                var $this = $(this);
                var $input = $this.closest('div').find('input');
                var value = parseInt($input.val());

                if (value > 1) {
                    value = value - 1;
                } else {
                    value = 0;
                }

                $input.val(value);

            });

            $(".input-qty").on("keypress keyup blur",function (event) {    
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });

            $('.plus-btn').on('click', function(e) {
                e.preventDefault();
                var $this = $(this);
                var $input = $this.closest('div').find('input');
                var value = parseInt($input.val());

                if (value < 100) {
                    value = value + 1;
                } else {
                    value =100;
                }

                $input.val(value);
            });

            $('.product-slider__show').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                adaptiveHeight: true,
                asNavFor: '.product-slider__list'
            });
            
            $('.product-slider__list').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                asNavFor: '.product-slider__show',
                dots: false,
                arrows: false,
                autoplay: true,
                autoplaySpeed: 5000,
                focusOnSelect: true,
                responsive: [
                    {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 1,
                    }
                    },
                    {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 1
                    }
                    },
                    {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 1
                    }
                    }
                ]
            });
        })
    </script>
</section>