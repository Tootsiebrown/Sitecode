<?php

namespace App\Repositories;

use App\Brand;

class BrandsRepository
{
    public function all()
    {
        return Brand::orderBy('name')
            ->get();
    }
}
