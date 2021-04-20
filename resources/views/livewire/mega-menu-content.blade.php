<div>
    <div class="row">
    @if ($hover)
        @foreach ($products as $product)
            <div class="col-4">
                {{ $product->title }}
            </div>
        @endforeach
    @endif
    </div>
</div>
