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

        $query = $this->sortListing($query);
        $query = $unfiltered
            ? $query
            : $this->filters->filterQuery($query);

        return $this->allowSecret
            ? $query->withoutGlobalScope('notSecret')
            : $query;
    }
    public function sortListing($query)
    {
        $params = request()->input('OrderBy');
        if (isset($params) && !empty($params)) {
            $data = explode('-', $params);
            $OrderBy = $data[0];
            $order = $data[1];
            if ($OrderBy == 'price') {
                return  $query->orderBy($OrderBy, $order);
            }
            if ($OrderBy == 'created_at') {
                return  $query->orderBy($OrderBy, $order);
            }
        }
        return $query->orderBy('created_at', 'desc');
    }
}
