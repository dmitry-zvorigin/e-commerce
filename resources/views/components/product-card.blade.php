<div class="card mb-4">
    <div class="row m-4">
        <div class="col-sm-3">
            @if ($product->images->isNotEmpty())
                <img class="bd-placeholder-img img-thumbnail" src="{{ asset('gallery_products/thumbnails/' . $product->images->first()->thumbnail) }}" alt="Описание изображения" width="200" height="200">
            @else
                <svg class="bd-placeholder-img img-thumbnail" width="200" height="200" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="A generic square placeholder image with a white border around it, making it resemble a photograph taken with an old instant camera: 200x200" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em"></text></svg>
            @endif
        </div>
        <div class="col-sm-6">
            <a href="{{ route('catalog.product', ['category' => $product->category->slug, 'product' => $product->slug]) }}" class="link-secondary text-decoration-none">
                <p class="fs-5 text-muted">{{ $product->name }} [{{ $product->detail }}]</p>
            </a>
            
            <x-product-rating :product="$product"/>
        </div>
        <div class="col-sm-3 text-end">
            
            <p class="h3">{{ $product->price }}</p>

            <div class="row text-end">
                <div class="col-sm-5">
                    <form method="post" action="">
                        @csrf
                        <button type="button" class="btn-add-wish btn btn-outline-danger" data-product-id="{{ $product->id }}">
                            <i class="bi bi-heart"></i>
                        </button>
                    </form>
                </div>
                <div class="col-sm-7">
                    <form method="post" action="">
                        {{-- {{ route('cart.addToCart') }} --}}
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="button" class="btn btn-primary">
                            <i class="bi bi-basket3"></i>
                            Купить
                        </button>
                    </form>
                </div>
            </div>

            
        </div>
    </div>
</div>
