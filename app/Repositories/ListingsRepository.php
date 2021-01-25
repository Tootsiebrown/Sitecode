<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;

class ListingsRepository extends BaseFilterableRepository
{
    protected $with = ['images'];
    protected bool $allowSecret = false;

    public function allowSecret()
    {
        $this->allowSecret = true;
    }

    public function getQuery($unfiltered = false): Builder
    {
        $query = !empty($this->with)
            ? $this->model->with($this->with)
            : $this->model->newQuery();

        $query = $this->previewMode
            ? $query->withAnyStatus()
            : $query->active();

        $query = $unfiltered
            ? $query
            : $this->filters->filterQuery($query);

        return $this->allowSecret
            ? $query->withoutGlobalScope('notSecret')
            : $query;
    }
}
