<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Listing;
use App\Models\Listing\EbayAspect;
use App\Models\Listing\EbayAspectValue;
use Illuminate\Http\Request;

trait HandlesEbayAspects
{
    private function addEbayAspectRequirements(Request $request, array $rules): array
    {
        foreach ($request->input('required_aspects', []) as $requiredAspect) {
            $rules['ebay_aspects.' . $requiredAspect] = 'required';
        }

        foreach ($request->input('ebay_aspects', []) as $maybeManualEntryAspect => $value) {
            if ($value === 'manual_entry') {
                $rules['ebay_manual_aspects.' . $maybeManualEntryAspect] = 'required';
            }
        }

        return $rules;
    }

    private function updateEbayAspects(
        Listing $listing,
        array $aspects,
        array $manualAspects,
        array $aspectCardinality
    ) {
        $listing
            ->ebayAspects
            ->each(fn ($aspect) => $aspect->values()->delete());

        $listing->ebayAspects()->delete();

        foreach ($aspects as $name => $values) {
            $ebayAspect = $listing->ebayAspects()->save(
                new EbayAspect([
                    'name' => $name,
                    'cardinality' => $aspectCardinality[$name],
                ])
            );

            if (!is_array($values)) {
                $values = [$values];
            }

            foreach ($values as $value) {
                if ($value == 'manual_entry') {
                    $ebayAspect->values()->save(
                        new EbayAspectValue([
                            'value' => $manualAspects[$name],
                            'manual' => true,
                        ])
                    );
                } else {
                    $ebayAspect->values()->save(
                        new EbayAspectValue([
                            'value' => $value
                        ])
                    );
                }
            }
        }
    }
}
