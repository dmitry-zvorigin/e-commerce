<div class="product-rating d-flex align-items-center">
    @for ($i = 0; $i < 5; $i++)
        @if ($i < $rating)
            <i class="fa fa-star"></i>
        @else
            <i class="fa fa-star-o"></i>
        @endif
    @endfor
    <div class="ms-2">
        {{ $product->reviews->count() }}
    </div>
</div>