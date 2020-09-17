<?php

namespace App\Repositories;

use Wax\Pages\Repositories\PagesRepository as WaxPagesRepository;

class PagesRepository extends WaxPagesRepository
{
    public function getTopLevel()
    {
        return $this
            ->getQuery()
            ->where(function ($query) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', 0);
            })
            ->where('exclude_from_menu', 0)
            ->orderBy('cms_sort_id')
            ->get();
    }
}
