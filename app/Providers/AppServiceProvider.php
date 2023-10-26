<?php

namespace App\Providers;

use App\Models\Product;
use App\Services\CartService;
use App\Services\ProductFilterService;
use App\Services\ProductService;
use App\Services\ProductSortingService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('product', function() {
            return new ProductService();
        });

        $this->app->singleton('product', function() {
            return new ProductSortingService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
