<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Category;
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
        return collect(
            [
                [
                    'title' => 'Shoes',
                    'caption' => 'Hiking, running, walking? We got it.',
                    'cta' => 'View Shoes',
                    'link' => '/search?search=shoe',
                    'background_image' => '/assets/img/slider/HikingGearBackground.jpg',
                    'image' => '/assets/img/slider/HikingShoes.png',
                ],
                [
                    'title' => 'iPhones',
                    'caption' => 'Soooo expensive. But not here!',
                    'cta' => 'View iPhones',
                    'link' => '/search?search=iphone',
                    'background_image' => '/assets/img/slider/iPHoneBackground.jpg',
                    'image' => '/assets/img/slider/iPhoneINHand.png',
                ],
                [
                    'title' => 'Whey Protein',
                    'caption' => 'Lorem Ipsum content goes here',
                    'cta' => 'View Protein Powder',
                    'link' => '/search?search=protein+powder',
                    'background_image' => '/assets/img/slider/ProteinPowderBackground.jpg',
                    'image' => '/assets/img/slider/ProteinPowder.png',
                ],
            ]
        );
    }
}
