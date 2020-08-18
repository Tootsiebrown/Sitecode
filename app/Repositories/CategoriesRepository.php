<?php

namespace App\Repositories;

use App\ProductCategory;

class CategoriesRepository
{
    public function top()
    {
        return ProductCategory
            ::top()
            ->with(['children.children'])
            ->get();
    }
}
