<?php

namespace App\Ebay\Requests;

abstract class AbstractRequest
{
    abstract public function setVersion(int $version): void;

    public function toArray(): array
    {
        return $this->data;
    }
}
