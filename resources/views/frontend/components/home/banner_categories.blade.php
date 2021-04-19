<section id="banner_categories">
    <x-title>
        <x-slot name='title'>
            Lốp xe - vỏ xe
        </x-slot>
        <x-slot name='class'>col-12 col-xl-11 mx-auto</x-slot>
    </x-title>
    <div class="row">
        <div class="col-12 col-xl-11 mx-auto">
            <div class="category">
                <div class="row">
                    @forelse ($categories as $category)
                        <div class="col-6 col-md col-lg text-center category__item py-3">
                            <a href="{{ ProductCategoryRoute($category) }}">
                                <img src="{{ $category->avatar_image }}" alt="{{ $category->name }}" class="img-fluid">
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center">@lang('text.not_found')</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
