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
        SearchFilter $searchFilter,
        SizeFilter $sizeFilter,
        ColorFilter $colorFilter,
        GenderFilter $genderFilter
    ) {
        $this->filters[$typeFilter->getName()] = $typeFilter;
        $this->filters[$categoryFilter->getName()] = $categoryFilter;
        $this->filters[$searchFilter->getName()] = $searchFilter;
        $this->filters[$sizeFilter->getName()] = $sizeFilter;
        $this->filters[$colorFilter->getName()] = $colorFilter;
        $this->filters[$genderFilter->getName()] = $genderFilter;
    }
}
