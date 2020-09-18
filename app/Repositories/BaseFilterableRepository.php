<?php

namespace App\Repositories;

use App\Support\Filters\FilterAggregatorContract;
use App\Support\Filters\HasFilters;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Use bindings on the extension to get the proper model and aggregator injected
 */
abstract class BaseFilterableRepository implements FilterableRepositoryContract
{
    use HasFilters;

    protected $previewMode = false;
    protected $with = [];

    public function __construct(Model $model, FilterAggregatorContract $filters)
    {
        $this->filters = $filters;
        $this->model = $model;
    }

    public function getAll(): Collection
    {
        return $this->getQuery()->get();
    }

    public function getPaginated(int $perPage): Paginator
    {
        $paginator = $this
            ->getQuery()
            ->paginate($perPage);

        $this->filters->appendToPaginator($paginator);

        return $paginator;
    }

    public function getForIndex(array $excludeAsFeatured = []): Collection
    {
        $query = $this
            ->getQuery()
            ->when($excludeAsFeatured, function ($builder) use ($excludeAsFeatured) {
                return $builder->whereNotIn('id', array_map(function ($model) {
                    return $model['id'];
                }, $excludeAsFeatured));
            });

        return $this->filters->filterQuery($query)->get();
    }


    public function with(array $with): FilterableRepositoryContract
    {
        $this->with = $with;

        return $this;
    }

    public function previewMode(bool $preview = true): FilterableRepositoryContract
    {
        $this->previewMode = $preview;

        return $this;
    }

    public function getQuery($unfiltered = false): Builder
    {
        $query = !empty($this->with)
            ? $this->model->with($this->with)
            : $this->model->newQuery();

        $query = $this->previewMode
            ? $query->withAnyStatus()
            : $query;

        return $unfiltered
            ? $query
            : $this->filters->filterQuery($query);
    }
}
