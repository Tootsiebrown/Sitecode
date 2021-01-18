<?php

namespace App\Ebay;

use Illuminate\Support\Collection;

class EbayItemAspect
{
    private bool $required;
    private Collection $options;
    private string $cardinality;
    private string $type;
    private string $name;

    /**
     * EbayItemAspect constructor.
     * @param $aspect
     */
    public function __construct($aspect)
    {
        $this->required = $aspect->aspectConstraint->aspectRequired;

        if (isset($aspect->aspectValues)) {
            $this->options = collect($aspect->aspectValues)
                ->mapWithKeys(fn ($value) => [$value->localizedValue => $value->localizedValue]);
        } else {
            $this->options = collect();
        }

        $this->cardinality = strtolower($aspect->aspectConstraint->itemToAspectCardinality);

        if ($this->options && $this->cardinality === 'single') {
            $this->type = 'select';
        } elseif ($this->options && $this->cardinality === 'multi') {
            $this->type = 'checkboxes';
        } else {
            \Log::info(print_r($this, 1));
            throw new \Exception('need to implement a new type...');
        }

        $this->name = $aspect->localizedAspectName;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getCardinality()
    {
        return $this->cardinality;
    }
}
