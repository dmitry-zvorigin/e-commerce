<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class CartController extends Controller
{
    public function index() : View
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        $cartSumItems = Cart::getSumAttribute();
        return view('cart.index', compact('cartItems', 'cartSumItems'));
    }

    public function store(Request $request)
    {
        dump($request->header('referer'));
        // Добавление товара в корзину
        Cart::create([
            'user_id' => auth()->id(), // предполагается, что у вас есть аутентификация
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity', 1),
        ]);

        $previousUrl = $request->header('referer');
        return redirect($previousUrl);
        return redirect()->route('cart.index');
    }

    // public function add(Request $request)
    // {
    //     // dd($request);
    //     CartItem::create([
    //         'user_id' => auth()->id(),
    //         'product_id' => $request->input('product_id'),
    //     ]);

    //     return redirect()->route('cart.index');
    // }
    public function update(Request $request, $id)
    {
        // Обновление количества товара в корзине
        $cartItem = Cart::findOrFail($id);
        $cartItem->update(['quantity' => $request->input('quantity')]);

        return redirect()->route('cart.index');
    }

    public function destroy($id)
    {
        // Удаление товара из корзины
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.index');
    }
}
