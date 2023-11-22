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
                        <button type="button" class="btn-add-wish btn btn-outline-danger" data-product-id="{{ $product->id }}">
                            <i class="bi bi-heart"></i>
                        </button>
                    </form>
                </div>
                <div>
                    <form method="post" action="">
                        {{-- {{ route('cart.addToCart') }} --}}
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="button" class="btn btn-primary">
                            <i class="bi bi-basket3"></i>
                            В корзину
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-add-wish').on('click', function() {
            const productId = $(this).data('product-id'); // Получаем ID отзыва из кнопки
            console.log('{{ csrf_token() }}');
            $.ajax({
                type: 'POST',
                url: '/add-to-wishlist',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId
                },
                success: function(response) {
                    console.log('Продукт успешно добавлен в избранное');
                },
                error: function() {
                    alert('Произошла ошибка при добавлении в избранное');
                }
            });
        });
    });
</script>