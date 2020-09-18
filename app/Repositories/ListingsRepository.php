<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;

class ListingsRepository extends BaseFilterableRepository
{
    public function getQuery($unfiltered = false): Builder
    {
        $query = !empty($this->with)
            ? $this->model->with($this->with)
            : $this->model->newQuery();

        $query = $this->previewMode
            ? $query->withAnyStatus()
            : $query->active();

        return $unfiltered
            ? $query
            : $this->filters->filterQuery($query);
    }
}
