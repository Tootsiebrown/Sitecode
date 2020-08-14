<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Category;
use App\ProductCategory;

class HomeController extends Controller
{

    public function index()
    {
        $top_categories = ProductCategory::top()->orderBy('name', 'asc')->get();

        $limit_regular_ads = get_option('number_of_free_ads_in_home');

        $ads = Ad::active()->with('categories', 'city', 'state', 'country')
            ->limit($limit_regular_ads)
            ->orderBy('id', 'desc')->get();

        $total_ads_count = Ad::active()->count();

        return view('index', compact('top_categories', 'ads', 'total_ads_count'));
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
