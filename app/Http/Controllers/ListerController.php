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
        $search = $request->input('search');

        $products = Product::where('upc', $search)
            ->orderBy('name', 'asc')
            ->paginate(20);

        return view(
            'dashboard.lister.index',
            [
                'search' => $search,
                'title' => 'Product Listings',
                'products' => $products,
            ]
        );
    }

    public function newProduct(Request $request)
    {
        $rules = [
            'name' => 'required',
            'upc' => 'required',
        ];
        $this->validate($request, $rules);

        $data = [
            'name' => $request->name,
            'upc' => $request->upc,
        ];

        $product = Product::create($data);

        return view('dashboard.lister.create_listing', [
            'product' => $product,
        ])->with('success', trans('app.product_created'));
    }

    public function newListing($product_id, Request $request)
    {
        $product = Product::find($product_id);

        if (!$product) {
            return back()->with('error', 'Product not found');
        }

        return view('dashboard.lister.create_listing', [
            'product' => $product,
        ]);
    }
}
