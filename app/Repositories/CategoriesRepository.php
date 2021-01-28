<?php

namespace App\Repositories;

use App\Models\ProductCategory;

class CategoriesRepository
{
    public function top()
    {
        return ProductCategory
            ::top()
            ->hasListings()
            ->with([
                'children' => function ($query) {
                    $query->hasListings()
                        ->orderBy('name');
                },
                'children.children' => function ($query) {
                    $query->hasListings()
                        ->orderBy('name');
                },
                'children.parent',
                'children.children.parent.parent',
            ])
            ->orderBy('name')
            ->get();
    }
}
