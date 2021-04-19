<section id="product_category">
    <x-title>
        <x-slot name="title">{{ isset($category) ? $category->name : $title_page}}</x-slot>
        <x-slot name="teaser">{{ $configGeneral->slogan }}</x-slot>
        <x-slot name='class'>col-12 col-xl-11 mx-auto</x-slot>
    </x-title>
    <div class="row">
        <div class="col-12 col-xl-11 mx-auto">                           
            @if(request()->route()->getName() == "home")
                @forelse ($categories as $cate)
                    <div class="category mt-4">
                        <h5 class="category__title">
                            <span>
                                {{ $cate->name }}
                            </span>
                        </h5>
                    </div>
                    <div class="product px-2">
                        <div class="row">
                            @php
                                $i = 0
                            @endphp
                            @forelse ($cate->products->where('publish', 1)->where('highlight', 1)->sortByDesc("created_at") as $product)
                                @if ($i < 8)
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
                                    @php
                                        $i++
                                    @endphp
                                @endif
                            @empty
                                @forelse ($cateall->where('parent_id', $cate->id) as $sub_cate)
                                    @foreach ($sub_cate->products()->orderBy('sort_order', 'desc')->where('publish', 1)->where('highlight', 1)->get() as $product)
                                        @if ($i < 8)
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
                                            @php
                                                $i++
                                            @endphp
                                        @endif
                                    @endforeach
                                @empty
                                    <div class="col-12">
                                        <p class="text-center">@lang('text.not_found')</p>
                                    </div>
                                @endforelse
                            @endforelse
                        </div>
                    </div>
                @empty
                    <p class="text-center">@lang('text.not_found')</p>
                @endforelse
            @elseif(request()->route()->getName() == "search")
                <div class="product px-2">
                    <div class="row">
                        @forelse ($products as $product)
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
                        <div class="col-12 mt-4">
                            {{ $products->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            @else
                @if ($categories->where('parent_id', $category->id)->count() > 0)
                    <livewire:filter :categories="$categories" :category="$category" :perPage="8" :cateall="$cateall"/>  
                    @forelse($categories->where('parent_id', $category->id) as $cate) 
                       
                        
                        @section('title')
                            {{ $cate->meta_title }}
                        @endsection
                        @section('meta_keyword')
                            {{ $cate->meta_keyswords }}
                        @endsection
                        @section('meta_desc')
                            {{ $cate->meta_desc }}
                        @endsection

                    @empty

                    @endforelse
                @else
                    <livewire:product-list :cate="$category" :perPage="12"/>

                    @section('title')
                        {{ $category->meta_title }}
                    @endsection
                    @section('meta_keyword')
                        {{ $category->meta_keyswords }}
                    @endsection
                    @section('meta_desc')
                        {{ $category->meta_desc }}
                    @endsection
                @endif
            @endif
        </div>
    </div>
</section>