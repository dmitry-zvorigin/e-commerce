<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class WishController extends Controller
{
    public function addToWishList(Request $request) : JsonResponse
    {
        $request->validate([
            "product_id"=> "required|exists:products,id",
        ]);

        $productId = $request->input('product_id');
        $userId = auth()->user()->id;

        Wishlist::create([
            'user_id' => $userId,
            'product_id'=> $productId
        ]);
        return response()->json(['suceccess' => true]);
    }

    public function index() : View
    {
        $wishLists = Wishlist::where('user_id', auth()->user()->id)->with('product')->get();

        return view('catalog.wishList', ['wishLists' => $wishLists]);    
    }
}
