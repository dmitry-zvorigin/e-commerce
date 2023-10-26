<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{

    public function index(Request $request) : View
    {
        // $search = $request->input("search");

        // $categories = Category::whereRaw("MATCH(name) AGAINST(? IN BOOLEAN MODE)", [$search])->paginate(10);

        // $categories = Category::paginate(10);

        if ($request->has('search')) {
            $search = $request->input('search');
            $categories = Category::search($search)->paginate(10);
        } else {
            $categories = Category::paginate(10);
        }

        return view("category.index", compact("categories"));
    }

    public function show(string $slug) : View
    {
        $category = Category::whereSlug($slug)->firstOrFail();

        return view("category.show", compact("category"));
    }

    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $category = new Category();
        $category->name = $request->input('name');

        $category->save();

        return redirect()->route('admin.categories.index')->with('success','Категория успешно добавлена');
    }

    public function create() : View
    {
        return view('category.create');
    }

    public function edit(string $slug) : View
    {
        $category = Category::whereSlug($slug)->firstOrFail();
        return view('category.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category) : RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $category->name = $request->input('name');
        $category->slug = $category->getSlugAttribute();
        $category->update();

        return redirect()->route('admin.categories.show', ['category' => $category->slug])->with('success','Категория успешно изменена');
    }

    public function destroy(Category $category) : RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Product deleted successfully');
    }
}
