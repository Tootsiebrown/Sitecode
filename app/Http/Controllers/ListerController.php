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

    public function addProduct(Request $request)
    {
        $product = new Product;
        $product
            ->fill($request->except('_token'))
            ->save();

        return redirect(route('lister.index'));
    }
}
