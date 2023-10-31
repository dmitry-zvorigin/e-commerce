<?php

namespace App\Services;

use App\Models\Product;

class RatingService
{
    // Подсчет рейтинга продукта с процентовкой
    public function calculateRatingPercentage(Product $product) : array
    {
        $reviews = $product->reviews;

        $starCounts = [0, 0, 0, 0, 0];

        $totalReviews = count($reviews);

        foreach ($reviews as $review) {
            $rating = $review->rating;
            $starCounts[$rating - 1]++;
        }

        $stars = [];

        for ($i = 4; $i >= 0; $i--) {
            $percentage = (int) ($totalReviews > 0 ? ($starCounts[$i] / $totalReviews) * 100 : 0);
            $stars[] = ['name' => ($i + 1), 'percentage' => $percentage];
        }

        // for ($i = 0; $i < 5; $i++) {
        //     $percentage = (int) (($totalReviews > 0) ? ($starCounts[$i] / $totalReviews) * 100 : 0);
        //     $stars[] = ['name' => ($i + 1), 'percentage' => $percentage];
        // }

        return $stars;
    }
}
