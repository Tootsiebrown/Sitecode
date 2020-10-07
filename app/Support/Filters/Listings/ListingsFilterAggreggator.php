<?php

namespace App\Support\Filters\Listings;

use App\Support\Filters\FilterAggregator;

class ListingsFilterAggreggator extends FilterAggregator
{
    protected $with = ['images'];

    /**
     * Need new filterContract for typehint
     */
    public function __construct(
        TypeFilter $typeFilter,
        CategoryFilter $categoryFilter,
        SearchFilter $searchFilter
//        BrandFilter $brandFilter
    ) {
        $this->filters[$typeFilter->getName()] = $typeFilter;
        $this->filters[$categoryFilter->getName()] = $categoryFilter;
        $this->filters[$searchFilter->getName()] = $searchFilter;
//        $this->filters[$brandFilter->getName()] = $brandFilter;
    }
}
