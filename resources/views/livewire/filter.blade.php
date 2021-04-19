<div>
    <div class="float-right form-inline ">
        <label for="filter">
            Lọc theo chiều rộng lốp: 
        </label>
        <select id="filter" wire:model="filter" class="form-control ml-2">
            <option value="">Tất cả</option>
            @foreach (App\Size::where('publish', 1)->get() as $item)
                <option value="{{ $item->code }}">{{ $item->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="clearfix"></div>
    @forelse($categories->where('parent_id', $category->id) as $cate) 
        <livewire:product-list :cate="$cate" :perPage="8" :products="$products" :key="$cate->id" :cateall="$cateall"/>
    @empty
    @endforelse
</div>
