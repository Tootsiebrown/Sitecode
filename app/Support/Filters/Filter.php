<?php

namespace App\Support\Filters;

use Illuminate\Contracts\Pagination\Paginator;

class Filter
{
    protected $model;
    protected $baseModel;
    protected $relation;
    protected $inverseRelation;
    protected $name;
    protected $value;
    protected $isActive = false;

    public function value()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->isActive = true;
        $this->value = $value;

        return $this;
    }

    public function appendToPaginator(Paginator $paginator)
    {
        if (!empty($this->value)) {
            $paginator->appends($this->name, $this->value);
        }
    }

    public function getName()
    {
        return $this->name;
    }
}
