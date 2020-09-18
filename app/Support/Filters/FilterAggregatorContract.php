<?php

namespace App\Support\Filters;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface FilterAggregatorContract
{
    public function filterQuery(Builder $query, $excludedFilter = null): Builder;
    public function getFilterOptions(Builder $query): array;
    public function appendToPaginator(Paginator $paginator);
    public function setFilter(string $key, $value);
    public function getFilterKeys(): array;
}
