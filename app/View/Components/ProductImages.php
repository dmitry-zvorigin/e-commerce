<?php

namespace App\View\Components;

use App\Models\Gallery_product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ProductImages extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $images,
    )
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-images');
    }
}
