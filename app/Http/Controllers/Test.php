<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class Test extends Controller
{

    public function test(Request $request) : View
    {
        // Получаем отфильтрованный список продуктов
        $filters = $request->input('filters', []);

        $categories = Category::all();
        $colors = Product::distinct()->pluck('color');
        $products = Product::filter($filters)->get();

        return view('test', compact('products', 'categories', 'colors'));
    }


}
