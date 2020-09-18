<?php

namespace App\Support\Filters;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

abstract class FilterAggregator implements FilterAggregatorContract
{
    public function filterQuery(Builder $query, $excludedFilter = null): Builder
    {
        foreach ($this->filters as $filterName => $filter) {
            if ($excludedFilter === $filterName) {
                continue;
            }

            $filter->filterQuery($query);
        }

        return $query;
    }

    public function getFilterOptions(Builder $query): array
    {
        $filterOptions = [];

        foreach ($this->filters as $filterName => $filter) {
            $filterSpecificQuery = clone $query;
            $filterSpecificQuery->setQuery(clone $query->getQuery());
            $filterOptions[$filterName] = $filter->getOptions(
                $this->filterQuery($filterSpecificQuery, $filterName)
            );
        }

        return $filterOptions;
    }

    public function appendToPaginator(Paginator $paginator)
    {
        foreach ($this->filters as $filter) {
            $filter->appendToPaginator($paginator);
        }
    }

    public function setFilter(string $key, $value)
    {
        $this->filters[$key]->setValue($value);
    }

    public function getFilterKeys(): array
    {
        return array_keys($this->filters);
    }
}
