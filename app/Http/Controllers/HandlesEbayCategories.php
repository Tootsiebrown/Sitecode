<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

trait HandlesEbayCategories
{

    public function getEbayCategories(Request $request)
    {
        $ebayCategories = [];
        for ($i = 1; $i <= 7; $i++) {
            $inputName = 'ebay_category_' . $i;
            if ($request->has($inputName) && !empty($request->input($inputName))) {
                $ebayCategories[] = $request->input($inputName);
            }
        }

        $ebayCategories = implode(',', $ebayCategories);

        if (empty($ebayCategories)) {
            return null;
        }

        return $ebayCategories;
    }
}
