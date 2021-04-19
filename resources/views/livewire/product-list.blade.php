@php
    if($products){
        $product_list = $products->where('product_category_id', $cate->id)->where('publish', 1)->sortByDesc("created_at")->collect_paginate($perPage, $cate->name);
        if($product_list->count() == 0){
            foreach ($cateall->where('parent_id', $cate->id)->where('publish', 1) as $sub_cate){
                foreach ($products->where('product_category_id', $sub_cate->id)->where('publish', 1) as $product){
                    $product_arr[] = $product;
                }
                if(isset($product_arr)) {
                    $product_list = collect($product_arr)->collect_paginate($perPage, $cate->name);
                }
            }
        }
    } else {
        $product_list = $cate->products->where('publish', 1)->sortByDesc("created_at")->collect_paginate($perPage, $cate->name);
    }
@endphp
<div>
    @if($product_list->count() > 0)
    <div class="category mt-4">
        <h5 class="category__title">
            <span>
                {{ $cate->name }}
            </span>
        </h5>
    </div>
    <div class="product px-2">
        <div class="row">
            @forelse ($product_list as $product)
                <div class="col-6 col-lg-3 px-1">
                    <x-product>
                        <x-slot name="title">{{ $product->title }}</x-slot>
                        <x-slot name="price">{{ number_format($product->price, 0, ',', '.') }}</x-slot>
                        <x-slot name="discount">{{ $product->disocunt }}</x-slot>
                        <x-slot name="image">{{ $product->avatar_image }}</x-slot>
                        <x-slot name="url">{{ ProductDetailRoute($product) }}</x-slot>
                        <x-slot name='url_order'>Url_order</x-slot>
                    </x-product>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">@lang('text.not_found')</p>
                </div>
            @endforelse
        </div>
        <div class="my-2">
            {{ $product_list->links() }}
        </div>
    </div>
    @endif
</div>
