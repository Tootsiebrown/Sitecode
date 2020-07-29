<?php

namespace App\Http\Controllers;

use App\Gateways\DatafinitiGateway;
use App\Product;
use Illuminate\Http\Request;

class ProfilerController
{
    public function index()
    {
        return view('dashboard.profiler.profile');
    }

    public function profileSearch(Request $request)
    {
        $search = $request->input('search');

        $gateway = app()->make(DatafinitiGateway::class);

        $profiles = collect($gateway->barCodeSearch($search))
            ->map(function ($item) {
                return [
                    'name' => $item['name'],
                    'upc' => $item['upca'],
                ];
            });

        return view(
            'dashboard.profiler.profile',
            [
                'search' => $search,
                'profiles' => $profiles,
            ]
        );
    }

    public function newProduct()
    {
        return view('dashboard.profiler.create_product');
    }

    public function saveProduct(Request $request)
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
}
