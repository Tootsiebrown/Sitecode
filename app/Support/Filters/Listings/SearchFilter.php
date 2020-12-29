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

class SearchFilter extends Filter
{
    protected $baseModel = Listing::class;
    protected $name = 'search';

    public function filterQuery(Builder $query)
    {
        if ($this->isActive) {
            $searchRepo = app()->make(ListingsSearchRepository::class);
            $results = $searchRepo->search($this->value, 1, 100, 'listings');

            if ($results['count'] == 0) {
                $query->whereRaw('1 = 0');
                return;
            }

            $listingIds = collect($results['results'])
                ->map(function ($result) {
                    if ($result['weight'] < 1) {
                        return null;
                    }

                    $url = $result['url'];
                    $urlPieces = explode('/', $url);
                    return $urlPieces[4] ?? null;
                })
                ->filter();

            $query->whereIn('id', $listingIds);

            $listingIds->each(function ($listingId) use ($query) {
                $query->orderBy(DB::raw('listings.id = ' . $listingId), 'desc');
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
