<?php

namespace App;

trait HasProductCategories
{
    public function getCategoryAttribute()
    {
        return $this
            ->categories
            ->filter(function ($category) {
                return $category->parent_id === 0;
            })
            ->first();
    }

    public function getChildCategoryAttribute()
    {
        if (! $this->category) {
            return null;
        }

        return $this
            ->categories
            ->filter(function ($category) {
                return $category->parent_id === $this->category->id;
            })
            ->first();
    }

    public function getGrandchildCategoryAttribute()
    {
        if (! $this->child_category) {
            return null;
        }

        return $this
            ->categories
            ->filter(function ($category) {
                return $category->parent_id === $this->child_category->id;
            })
            ->first();
    }
}
