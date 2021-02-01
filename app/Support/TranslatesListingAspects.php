<?php

namespace App\Support;

use App\Models\Listing;

trait TranslatesListingAspects
{
    protected function getListingAspects(Listing $listing, $collapseSingular = true, $includeManual = false)
    {
        return $listing
            ->ebayAspects
            ->mapWithKeys(function ($aspect) use ($collapseSingular, $includeManual) {
                if ($aspect->cardinality === 'single' && $collapseSingular) {
                    $value = $aspect->values->first();
                    if ($includeManual || !$value->manual) {
                        $aspectValue = $value->value;
                    } elseif ($value->manual) {
                        $aspectValue = 'manual_entry';
                    } else {
                        $aspectValue = null;
                    }
                } else {
                    $aspectValue = $aspect
                        ->values
                        ->when(!$includeManual, function ($collection) {
                            return $collection->filter(
                                fn($value) => !$value->manual
                            );
                        })
                        ->pluck('value')
                        ->all();
                }

                return [$aspect->name => $aspectValue];
            })
            ->all();
    }

    protected function getListingManualAspectsForEditing($listing)
    {
        return $listing
            ->ebayAspects
            ->mapWithKeys(function ($aspect) {
                if ($aspect->cardinality !== 'single') {
                    return ['' => null];
                }

                $value = $aspect->values->first();
                if ($value->manual) {
                    return [$aspect->name => $value->value];
                }

                return ['' => null];
            })
            ->filter()
            ->all();
    }
}
