<section id="product_relate">
    <x-title>
        <x-slot name='title'>Sản phẩm liên quan</x-slot>
        <x-slot name='class'>col-12 col-lg-11 mx-auto</x-slot>
    </x-title>
    <div class="row">
        <div class="col-12 col-lg-11 mx-auto">
            <div class="product">
                <div class="row">
                    @foreach ($product->productCategory->products->where('publish', 1)->sortByDesc("created_at") as $product)
                        <div class="col-6 col-md-4 col-lg-3 px-1">
                            <x-product>
                                <x-slot name="title">{{ $product->title }}</x-slot>
                                <x-slot name="price">{{ number_format($product->price, 0, ',', '.') }}</x-slot>
                                <x-slot name="discount">{{ $product->disocunt }}</x-slot>
                                <x-slot name="image">{{ $product->avatar_image }}</x-slot>
                                <x-slot name="url">{{ ProductDetailRoute($product) }}</x-slot>
                                <x-slot name='url_order'>Url_order</x-slot>
                            </x-product>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>