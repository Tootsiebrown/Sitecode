<?php

namespace App\Support\Filters\Listings;

use App\Models\Listing;
use App\Support\Filters\Filter;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;

class SearchFilter extends Filter
{
    protected $baseModel = Listing::class;
    protected $name = 'search';

    public function filterQuery(Builder $query)
    {
        if ($this->isActive) {
            $query->where(function ($query) {
                return $query->orWhere('listings.title', 'like', "%{$this->value}%")
                    ->orWhere('listings.description', 'like', "%{$this->value}%");
            });
        }
    }

    public function getOptions($possibilitiesQuery)
    {
        return [];
    }

    public function appendToPaginator(Paginator $paginator)
    {
        if (!empty($this->value)) {
            $paginator->appends('search', $this->value);
        }
    }
}
