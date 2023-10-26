<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class CatalogController extends Controller
{
    public function index() : View
    {
        $categories = Category::all();
        return view('catalog.categories', compact('categories'));
    }
}
