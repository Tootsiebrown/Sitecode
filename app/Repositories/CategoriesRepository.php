<?php

namespace App\Repositories;

use App\ProductCategory;

class CategoriesRepository
{
    public function top()
    {
        return ProductCategory
            ::top()
            ->hasListings()
            ->with([
                'children' => function ($query) {
                    $query->hasListings();
                },
                'children.children' => function ($query) {
                    $query->hasListings();
                }
            ])
            ->get();
    }
}
