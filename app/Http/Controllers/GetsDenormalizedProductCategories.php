<?php

namespace App\Http\Controllers;

use App\ProductCategory;

trait GetsDenormalizedProductCategories
{
    protected function getDenormalizedProductCategories()
    {
        $categories = ProductCategory::top()->get()->keyBy('id');
        $childCategories = ProductCategory::whereIn('parent_id', $categories->pluck('id'))->get()->keyBy('id');
        $grandchildCategories = ProductCategory::whereIn('parent_id', $childCategories->pluck('id'))->get()->keyBy('id');

        return $categories
            ->mapWithKeys(function ($category, $key) use ($categories, $childCategories, $grandchildCategories) {
                $categories->forget($key);
                return [
                    $category->id => [
                        'id' => $category->id,
                        'name' => $category->name,
                        'children' => $childCategories
                            ->filter(function ($childCategory) use ($category) {
                                return $childCategory->parent_id === $category->id;
                            })
                            ->mapWithKeys(function ($childCategory, $key) use ($childCategories, $grandchildCategories) {
                                $childCategories->forget($key);
                                return [
                                    $childCategory->id => [
                                        'id' => $childCategory->id,
                                        'name' => $childCategory->name,
                                        'children' => $grandchildCategories
                                            ->filter(function ($grandchildCategory) use ($childCategory) {
                                                return $grandchildCategory->parent_id === $childCategory->id;
                                            })
                                            ->mapWithKeys(function ($grandchildCategory, $key) use ($grandchildCategories) {
                                                $grandchildCategories->forget($key);
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
