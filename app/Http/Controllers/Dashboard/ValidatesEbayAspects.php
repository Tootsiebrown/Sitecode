<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

trait ValidatesEbayAspects
{
    private function addEbayAspectRequirements(Request $request, array $rules): array
    {
        foreach ($request->input('required_aspects', []) as $requiredAspect) {
            $rules['ebay_aspect.' . $requiredAspect] = 'required';
        }

        return $rules;
    }
}
