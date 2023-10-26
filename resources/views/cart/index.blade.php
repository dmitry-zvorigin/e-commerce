@extends('layouts.app')

@section('content')
    <div class="container">
    <h1>Ваша корзина</h1>

    @if (!$cartItems->isEmpty())
        <table>
            <thead>
                <tr>
                    <th>Товар</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th>Итого</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $cartItem)
                    <tr>
                        <td>{{ $cartItem->product->name }}</td>
                        <td>
                            <form action="{{ route('cart.updateCart', $cartItem->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $cartItem->quantity }}">
                                <button type="submit">Обновить</button>
                            </form>
                        </td>
                        <td>{{ $cartItem->product->price }}</td>
                        <td>{{ $cartItem->total }}</td>
                        <td>
                            <form action="{{ route('cart.removeFromCart', $cartItem->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <h4>Сумма: {{ $cartSumItems }}</h4>
        </div>
    @else
        <p>Ваша корзина пуста.</p>
    @endif



    <a href="{{ route('products.index') }}">Продолжить покупки</a>
</div>
@endsection
