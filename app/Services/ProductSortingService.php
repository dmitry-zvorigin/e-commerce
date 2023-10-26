<?php

namespace App\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;

class ProductSortingService
{
    public function applySorting($query, ?string $sorting) : Builder
    {
        //TODO Логика сортировки товара
        if (isset($sorting)) {
            $sortOptions = [
                'price_asc' => ['price', 'asc'],
                'price_desc' => ['price', 'desc'],
                'name_asc' => ['name', 'asc'],
                'name_desc' => ['name', 'desc'],
                'created_at_asc' => ['updated_at', 'asc'],
                'created_at_desc' => ['updated_at', 'desc'],
            ];

            if (array_key_exists($sorting, $sortOptions)) {
                $query->orderBy($sortOptions[$sorting][0], $sortOptions[$sorting][1]);
            }
        }

        return $query;
    }
}
