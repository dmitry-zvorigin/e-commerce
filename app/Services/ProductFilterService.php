<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProductFilterService
{

    public function applyFilters($query, array $filters) : Builder
    {
        //TODO Логика объединения фильтрации товаров
        if (isset($filters['category'])) {
            $this->filterByCategory($query, $filters['category']);
        }

        if (isset($filters['min_price']) && isset($filters['max_price'])) {
            $this->filterByPriceRange($query, $filters['min_price'], $filters['max_price']);
        }

        if (isset($filters['color'])) {
            $this->filterByColor($query, $filters['color']);
        }

        return $query;
    }

    protected function filterByCategory($query, int $categoryId)
    {
        //TODO Логика фильтрации товара по категории
        $query->where('category_id', $categoryId);
    }

    protected function filterByPriceRange($query, float $minPrice, float $maxPrice)
    {
        //TODO Логика фильтрации товара по цене
        $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    protected function filterByColor($query, string $color)
    {
        //TODO Логика фильтрации товара по цвету
        $query->where('color', $color);
    }
}
