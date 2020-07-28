<?php

namespace App\Http\Controllers;

use App\Ad;
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

        return back()->with('success', trans('app.product_created'));
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

    public function saveListing(Request $request)
    {
        $rules = [
            'ad_title' => 'required',
            'sku' => 'required',
            'bid_deadline' => 'required',
        ];
        $this->validate($request, $rules);

        $product = Product::find($request->product_id);

        $data = [
            'title' => $request->ad_title,
            'sku' => $request->sku,
            'expired_at' => $request->bid_deadline,
            'description' => $product->description,
            'features' => $product->features,
            'product_id' => $product->id,
            'upc' => $product->upc,
            'price' => $product->price,
        ];

        $product = Ad::create($data);

        return redirect(route('lister.index'))->with('success', 'Listing successfully saved');
    }
}
