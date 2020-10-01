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

        $listings = Listing::active()
            ->limit($limit_regular_ads)
            ->orderBy('id', 'desc')->get();

        $totalListingsCount = Listing::active()->count();

        return view('index', [
            'listings' => $listings,
            'totalListingsCount' => $totalListingsCount,
            'slides' => $this->getSlides(),
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
        return collect(
            [
                [
                    'title' => 'This is a Deal on Power Drills',
                    'caption' => 'Lorem ipsum dolor sit amet more text here please',
                    'cta' => 'View Power Drills',
                    'link' => '/search?search=drill',
                    'background_image' => '/assets/img/slider/slide1bg.png',
                    'image' => '/assets/img/slider/slide1.png',
                ],
                [
                    'title' => 'This is Another Deal on Jeans',
                    'caption' => 'Lorem ipggsum dolggor sit amgget more tggext here pleggase',
                    'cta' => 'View Blue Jeans',
                    'link' => '/search?search=jeans',
                    'background_image' => '/assets/img/slider/slide2bg.png',
                    'image' => '/assets/img/slider/slide2.png',
                ],
            ]
        );
    }
}
