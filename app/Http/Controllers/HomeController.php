<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Category;
use App\Models\Slide;
use App\Models\ProductCategory;

class HomeController extends Controller
{

    public function index()
    {
        $limitRegularAds = get_option('number_of_free_ads_in_home');

        $listings = Listing::with('categories', 'images')
            ->active()
            ->limit($limitRegularAds)
            ->orderBy('id', 'desc')->get();

        $totalListingsCount = Listing::active()->count();

        return view('index', [
            'listings' => $listings,
            'totalListingsCount' => $totalListingsCount,
            'slides' => $this->getSlides(),
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

    protected function getSlides()
    {
        return Slide::all();
    }
}
