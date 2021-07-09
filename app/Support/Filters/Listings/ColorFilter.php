<?php

namespace App\Support\Filters\Listings;

use App\Models\Listing;
use App\Repositories\ListingsSearchRepository;
use App\Support\Filters\Filter;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Wax\SiteSearch\Contracts\SiteSearchRepositoryContract;

class ColorFilter extends Filter
{
    protected $baseModel = Listing::class;
    protected $name = 'color';

    public function filterQuery(Builder $query)
    {
        if ($this->isActive) {
            $query->whereIn('color', $this->value);
        }
    }

    public function getOptions($possibilitiesQuery)
    {
        return [];
    }

    public function appendToPaginator(Paginator $paginator)
    {
        if (!empty($this->value)) {
            $paginator->appends('size', $this->value);
        }
    }
}
