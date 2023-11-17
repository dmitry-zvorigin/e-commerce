<div class="col">
    <div class="mt-4">
        <h3>{{ $product->detail }}</h3>
    </div>
    <div class="product-rating d-flex align-items-center">
        @for ($i = 0; $i < 5; $i++)
            @if ($i < round($product->averageRating))
                <i class="fa fa-star"></i>
            @else
                <i class="fa fa-star-o"></i>
            @endif
        @endfor
        <div class="ms-2">
            {{ $product->reviewCount() }}
        </div>
    </div>

    <div class="card">
        <div class="d-flex mb-3 mt-3 justify-content-around">
            <div>
                <h3>Цена: {{ $product->price }}</h3>
            </div>
            <div class="d-flex">
                <div class="mx-4">
                    <form method="post" action="">
                        @csrf
                        <button type="button" class="btn btn-outline-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"></path>
                            </svg><ya-tr-span data-index="20-1" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value=" " data-translation=" " data-ch="0" data-type="trSpan" data-selected="false">  </ya-tr-span><ya-tr-span data-index="20-2" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Button " data-translation="Кнопка " data-ch="0" data-type="trSpan" data-selected="true">В избранное</ya-tr-span></button>
                    </form>
                </div>
                <div>
                    <form method="post" action="">
                        {{-- {{ route('cart.addToCart') }} --}}
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="button" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket3" viewBox="0 0 16 16">
                            <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6h-9.21z"></path>
                        </svg><ya-tr-span data-index="20-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value=" Button " data-translation=" Кнопка " data-ch="0" data-type="trSpan">  Купить  </ya-tr-span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>