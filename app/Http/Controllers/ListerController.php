<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Gateways\DatafinitiGateway;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ListerController extends Controller
{
    protected $datafinitiGateway;

    public function __construct(DatafinitiGateway $datafinitiGateway)
    {
        $this->datafinitiGateway = $datafinitiGateway;
    }

    public function index(Request $request)
    {
        $upc = $request->input('upc');
        $name = $request->input('name');
        $searchBy = $request->input('search_by');
        $datafinitiUpc = $request->input('datafiniti_upc');

        switch ($searchBy) {
            case 'name':
                $searchString = $name;
                break;
            case 'upc':
                $searchString = $upc;
                break;
            default:
                $searchString = null;
        }

        return view(
            'dashboard.lister.index',
            [
                'title' => 'Product Listings',
                'upc' => $upc,
                'name' => $name,
                'searchBy' => $searchBy,
                'searchString' => $searchString,
                'products' => $this->productSearch(
                    $searchBy,
                    $upc,
                    $name
                ),
                'datafinitiUpc' => $datafinitiUpc,
                'datafinitiProfiles' => $this->datafinitiSearch($datafinitiUpc),
            ]
        );
    }

    private function productSearch($searchBy, $upc, $name)
    {
        if (is_null($searchBy)) {
            return collect();
        }

        switch ($searchBy) {
            case 'name':
                if (empty($name)) {
                    return collect();
                }
                $productsQuery = Product::where('name', 'like', "%$name%");
                break;
            case 'upc':
                if (empty($upc)) {
                    return collect();
                }
                $productsQuery = Product::where('upc', $upc);
                break;
            default:
                throw new \Exception('Invalid search method:' . $searchBy);
        }

        return $productsQuery
            ->orderBy('name', 'asc')
            ->paginate(20);
    }

    protected function datafinitiSearch($upc)
    {
        if (! $upc) {
            return collect();
        }

        return $this->datafinitiGateway->barCodeSearch($upc);
    }

    public function newProduct(Request $request)
    {
        if (null !== $request->input('from_profile')) {
            $key = $this->datafinitiGateway->getKey($request->input('upc'));
            $cache = Cache::store('database')->get($key);
            $product = $cache[$request->input('from_profile')];

            if (!empty($product['prices'])) {
                $product['original_price'] = $product['prices'][0]['amountMax'];
            }
            if (!empty($product['descriptions'])) {
                $product['description'] = implode(' ', $product['descriptions']);
            }
            if (!empty($product['features'])) {
                $productFeatures = collect($product['features'])->where('key', 'Product Features')->first();
                $productFeatures = $productFeatures['value'] ?? [];
                if (!empty($productFeatures)) {
                    $product['features'] = '<ul><li>' . implode('</li><li>', $productFeatures) . '</li></ul>';
                }
            }
        }

        return view('dashboard.lister.create_product', [
            'product' => $product ?? null,
        ]);
    }

    public function saveProduct(Request $request)
    {
        $rules = [
            'name' => 'required',
            'upc' => 'required',
            'price' => 'required',
            'description' => 'required',
        ];
        $this->validate($request, $rules);

        $data = [
            'name' => $request->name,
            'upc' => $request->upc,
            'original_price' => $request->original_price,
            'price' => $request->price,
            'condition' => ($request->condition == 'used' ? '0' : '1'),
            'description' => $request->description,
            'features' => $request->features,
            'gender' => $request->gender,
            'model_number' => $request->model_number,
            'color' => $request->color,
        ];

        $product = Product::create($data);

        return redirect(
            route('lister.newListing', [
                'product' => $product->id,
            ])
        )->with('success', trans('app.product_created'));
    }

    public function newListing(Request $request)
    {
        $product = Product::find($request->input('product'));

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
            'status' => 1,
        ];

        $product = Ad::create($data);

        return redirect(route('lister.index'))->with('success', 'Listing successfully saved');
    }
}
