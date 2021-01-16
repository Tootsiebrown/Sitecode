<?php

namespace App\Repositories;

use App\Models\Brand;

class BrandsRepository
{
    public function all()
    {
        return Brand::orderBy('name')
            ->hasListings()
            ->get();
    }
}
