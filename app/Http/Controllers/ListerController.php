<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ListerController extends Controller
{
    public function index()
    {
        return view(
            'dashboard.lister.index',
            [
                'title' => 'Product Listings',
            ]
        );
    }

    public function productSearch(Request $request)
    {
        $products = Product::where(
            function ($query) use ($request) {
                $query->where('upc', $request->input('search'))
                    ->orWhere('sku', $request->input('search'));
            }
        )
            ->orderBy('name', 'asc')
            ->paginate(20);

        return view(
            'dashboard.lister.index',
            [
                'title' => 'Product Listings',
                'products' => $products,
            ]
        );
    }
}
