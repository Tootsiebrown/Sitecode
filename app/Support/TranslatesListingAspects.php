<?php

namespace App\Support;

use App\Models\Listing;

trait TranslatesListingAspects
{
    protected function getListingAspects(Listing $listing, $collapseSingular = true)
    {
        return $listing
            ->ebayAspects
            ->mapWithKeys(function ($aspect) use ($collapseSingular) {
                if ($aspect->cardinality === 'single' && $collapseSingular) {
                    $aspectValue = $aspect->values->first()->value;
                } else {
                    $aspectValue = $aspect->values->pluck('value')->all();
                }

                return [$aspect->name => $aspectValue];
            })
            ->all();
    }
}
