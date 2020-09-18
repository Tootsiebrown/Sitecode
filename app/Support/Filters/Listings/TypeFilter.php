<?php

namespace App\Support\Filters\Listings;

use App\Models\Listing;
use App\Support\Filters\Filter;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Wax\Core\Filters\FilterOption;

class TypeFilter extends Filter
{
    protected $baseModel = Listing::class;
    protected $name = 'type';
    protected $types = [
        'set-price',
        'auction',
    ];

    public function filterQuery(Builder $query)
    {
        if ($this->isActive && in_array($this->value, $this->types)) {
            $query->where('type', $this->value);
        }
    }

    public function getOptions($possibilitiesQuery)
    {
        $possibilities = $possibilitiesQuery->pluck('id');
        $possibleAuctions = Listing::where('type', 'auction')
            ->whereIn('id', $possibilities);
        $possibleSetPrice = Listing::where('type', 'set-price')
            ->whereIn('id', $possibilities);

        return [
            new FilterOption(
                'Auction',
                'auction',
                [
                    'count' => $possibleAuctions->count(),
                ],
                $possibleAuctions->count() === 0,
                $this->value === 'auction'
            ),
            new FilterOption(
                'Set Price',
                'set-price',
                [
                    'count' => $possibleSetPrice->count(),
                ],
                $possibleSetPrice->count() === 0,
                $this->value === 'set-price',
            )
        ];
    }

    public function appendToPaginator(Paginator $paginator)
    {
        if (!empty($this->value)) {
            $paginator->appends('type', $this->value);
        }
    }
}
