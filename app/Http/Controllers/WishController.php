<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


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
}
