<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Category;
use App\ProductCategory;

class HomeController extends Controller
{

    public function index()
    {
        $limit_regular_ads = get_option('number_of_free_ads_in_home');

        $ads = Listing::active()->with('categories', 'images')
            ->limit($limit_regular_ads)
            ->orderBy('id', 'desc')->get();

        $total_ads_count = Listing::active()->count();

        return view('index', [
            'ads' => $ads,
            'total_ads_count' => $total_ads_count,
            'featuredListings' => Listing::with('images')->active()->featured()->take(12)->get(),
        ]);
    }

    /**
     * Switch Language
     */
    public function switchLang($lang)
    {
        session(['lang' => $lang]);
        return back();
    }
}
