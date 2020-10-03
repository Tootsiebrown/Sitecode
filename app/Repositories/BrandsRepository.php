<?php

namespace App\Repositories;

use App\Brand;

class BrandsRepository
{
    public function all()
    {
        return Brand::hasListings()
            ->orderBy('name')
            ->get();
    }
}
