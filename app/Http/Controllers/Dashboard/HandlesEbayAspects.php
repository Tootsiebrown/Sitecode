<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Listing;
use App\Models\Listing\EbayAspect;
use Illuminate\Http\Request;

trait HandlesEbayAspects
{
    private function addEbayAspectRequirements(Request $request, array $rules): array
    {
        foreach ($request->input('required_aspects', []) as $requiredAspect) {
            $rules['ebay_aspect.' . $requiredAspect] = 'required';
        }

        return $rules;
    }

    private function updateEbayAspects(Listing $listing, array $aspects)
    {
        $listing->ebayAspects()->delete();

        foreach($aspects as $name => $values) {
            if (!is_array($values)) {
                $values = [$values];
            }

            foreach ($values as $value) {
                $listing->ebayAspects()->save(
                    new EbayAspect([
                        'name' => $name,
                        'value' => $value
                    ])
                );
            }
        }
    }
}
