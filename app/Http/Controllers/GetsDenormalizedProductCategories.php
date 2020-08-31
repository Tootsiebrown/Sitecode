<?php

namespace App\Http\Controllers;

use App\ProductCategory;

trait GetsDenormalizedProductCategories
{
    protected function getDenormalizedProductCategories()
    {
        $categories = ProductCategory::all();

        return $categories
            ->filter(function ($category) {
                return $category->parent_id === 0;
            })
            ->mapWithKeys(function ($category) use ($categories) {
                return [
                    $category->id => [
                        'id' => $category->id,
                        'name' => $category->name,
                        'children' => $categories
                            ->filter(function ($childCategory) use ($category) {
                                return $childCategory->parent_id === $category->id;
                            })
                            ->mapWithKeys(function ($childCategory) use ($categories) {
                                return [
                                    $childCategory->id => [
                                        'id' => $childCategory->id,
                                        'name' => $childCategory->name,
                                        'children' => $categories
                                            ->filter(function ($grandchildCategory) use ($childCategory) {
                                                return $grandchildCategory->parent_id === $childCategory->id;
                                            })
                                            ->mapWithKeys(function ($grandchildCategory) {
                                                return [
                                                    $grandchildCategory->id => [
                                                        'id' => $grandchildCategory->id,
                                                        'name' => $grandchildCategory->name,
                                                    ]
                                                ];
                                            })
                                            ->values()
                                    ]
                                ];
                            })
                    ]
                ];
            });
    }
}
