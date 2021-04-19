<section id="product">
    <a href="{{ $url }}">
        <div class="border-product">
            <div class="border-product__image">
                <img src="{{ $image }}" alt="" class="img-fluid">
            </div>
            <div class="border-product__info">
                <h3 class="border-product__info--title">
                    {{ $title }}
                </h3>
                <p class="border-product__info--price">
                    <span>{{ $price == "0" ? "Xem chi tiết" : $price . " VNĐ" }}<span>
                </p>
                {{-- <a href="{{ $url_order }}" class="border-product__info--order">
                    <i class="fa fa-cart-plus" aria-hidden="true"></i>
                    Đặt hàng
                </a> --}}
            </div>
        </div>
    </a>
</section>