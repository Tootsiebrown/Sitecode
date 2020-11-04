<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Category;
use App\Models\Slide;
use App\ProductCategory;

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

        return collect(
            [
                [
                    'title' => 'Shoes',
                    'caption' => 'Get ready for Fall with great Dealz on boots and shoes for the whole family!',
                    'cta' => 'View Shoes',
                    'link' => '/search?category=1449',
                    'background_image' => '/assets/img/slider/HikingGearBackground.jpg',
                    'image' => '/assets/img/slider/HikingShoes.png',
                ],
                [
                    'title' => 'Apple iPhones and More',
                    'caption' => 'Find iPhones, iPads, MacBooks, AirPods and accessories all below wholesale!',
                    'cta' => 'View Electronics',
                    'link' => '/search?category=45',
                    'background_image' => '/assets/img/slider/iPHoneBackground.jpg',
                    'image' => '/assets/img/slider/iPhoneINHand.png',
                ],
                [
                    'title' => 'Fitness',
                    'caption' => 'Catch the best prices on fitness apparel and nutrition to help you look your best!',
                    'cta' => 'View Fitness',
                    'link' => '/search?search=fitness',
                    'background_image' => '/assets/img/slider/ProteinPowderBackground.jpg',
                    'image' => '/assets/img/slider/ProteinPowder.png',
                ],
            ]
        );
    }
}
