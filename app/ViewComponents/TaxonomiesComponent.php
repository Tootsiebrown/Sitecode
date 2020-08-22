<?php

namespace App\ViewComponents;

use App\Repositories\BrandsRepository;
use App\Repositories\CategoriesRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Support\Htmlable;

class TaxonomiesComponent implements Htmlable
{
    public function __construct(
        BrandsRepository $brandsRepo,
        CategoriesRepository $categoriesRepo
    ) {
        $this->brandsRepo = $brandsRepo;
        $this->categoriesRepo = $categoriesRepo;
    }

    public function toHtml()
    {
        return View::make('site.components.taxonomies')
            ->with([
                'categories' => $this->categoriesRepo->top(),
                'brands' => $this->brandsRepo->all()
            ]);
    }
}
