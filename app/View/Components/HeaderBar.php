<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Wishlist;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeaderBar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $categories = Category::all();

        $countWishList = Wishlist::Where('user_id', auth()->user()->id)->count();

        return view('components.header-bar', ['categories' => $categories, 'countWishList' => $countWishList]);
    }
}
