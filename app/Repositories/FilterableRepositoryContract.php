<?php

namespace App\Repositories;

use App\Filters\Traits\HasFilters;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Use bindings on the extension to get the proper model and aggregator injected
 */
interface FilterableRepositoryContract
{
    public function getFilterOptions(): array;
    public function setFilters(array $filters);
    public function setFilter(string $key, $value);
    public function getAll(): Collection;
    public function getPaginated(int $perPage): Paginator;
    public function getForIndex(array $excludeAsFeatured = []): Collection;
    public function with(array $with): FilterableRepositoryContract;
    public function previewMode(bool $preview = true): FilterableRepositoryContract;
    public function getQuery($unfiltered = false): Builder;
}
