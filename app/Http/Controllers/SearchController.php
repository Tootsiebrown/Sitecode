<?php
// namespace App\Http\Controllers;
// use Illuminate\Http\Request;
// use App\Models\Listing;
// use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\Dashboard\CropsProductImages;
// use App\Http\Controllers\Dashboard\HandlesEbayAspects;
// use App\Jobs\UpdateEbayOfferInventory;
// use App\Models\Brand;
// use App\Models\Listing\Image as ListingImage;
// use App\Models\ProductCategory;
// use App\Repositories\ListingsRepository;
// use Exception;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Str;
// use Illuminate\Validation\Rule;
// use Wax\Core\Traits\CanUseFilters;


// class SearchController extends Controller
/**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Search ads
     */
// {
//    public function index()
// {
// return view('search.search');
// }
// public function search(Request $request)

// {
// if($request->ajax())
// {
// $output="";
// $products=DB::table('listings')->where('slug','LIKE','%'.$request->search."%")->get();
// if($products)
// {
// foreach ($products as $key => $product) {
// $output.='<tr>'.
// '<td>'.$product->slug.'</td>'.
// '<td>'.$product->title.'</td>'.
// '<td>'.$product->description.'</td>'.
// '<td>'.$product->price.'</td>'.
// '</tr>';
// }
// return view('pages.search'); [
//     'title' => 'Search Results'
// ];
//    }
//    }
// }
// }
// made by DM for search bar... didnt work. left just incase.