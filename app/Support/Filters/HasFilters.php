<?php

namespace App\Support\Filters;

trait HasFilters
{
    protected $filters;
    protected $defaultAllLabel = 'All';

    public function getFilterOptions(): array
    {
        return $this->filters->getFilterOptions(
            $this->getQuery(true) // the base unfiltered query
        );
    }

    public function setFilters(array $filters)
    {
        foreach ($filters as $key => $value) {
            $this->filters->setFilter($key, $value);
        }
    }

    public function setFilter(string $key, $value)
    {
        $this->filters->setFilter($key, $value);
    }

    public function getFilterKeys()
    {
        return $this->filters->getFilterKeys();
    }

    public function getActiveFilters()
    {
        return $this->filters->getActiveFilters();
    }

    public function hasActiveFilters()
    {
        return $this->filters->hasActiveFilters();
    }
}
