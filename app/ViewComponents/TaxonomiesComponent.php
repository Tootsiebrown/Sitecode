<?php

namespace App\ViewComponents;

use App\Repositories\CategoriesRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Support\Htmlable;

class TaxonomiesComponent implements Htmlable
{
    public function __construct(
        CategoriesRepository $categoriesRepo
    ) {
        $this->categoriesRepo = $categoriesRepo;
    }

    public function toHtml()
    {
        return View::make('site.components.taxonomies')
            ->with([
                'categories' => $this->categoriesRepo->top(),
            ]);
    }
}
