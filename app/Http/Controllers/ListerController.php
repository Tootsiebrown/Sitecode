<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Brand;
use App\Gateways\DatafinitiGateway;
use App\Product;
use App\ProductCategory;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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
            $products = $this->datafinitiGateway->barCodeSearch($request->input('upc'));
            $product = $products[$request->input('from_profile')];

            if (!empty($product['prices'])) {
                $product['original_price'] = $product['prices'][0]['amountMax'];
            }
            if (!empty($product['descriptions'])) {
                $product['description'] = implode(' ', $product['descriptions']);
            }

            $productFeatures = '';
            if (!empty($product['features'])) {
                $productFeatures = collect($product['features'])->where('key', 'Product Features')->first();
                $productFeatures = $productFeatures['value'] ?? '';
                if (!empty($productFeatures)) {
                    $productFeatures = '<ul><li>' . implode('</li><li>', $productFeatures) . '</li></ul>';
                }
            }
            $product['features'] = $productFeatures;
        }

        return view('dashboard.lister.create_product', [
            'brands' => Brand::all(),
            'categories' => ProductCategory::where('parent_id', 0)->get(),
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

        if ($request->input('existing_brand')) {
            $brand = Brand::find($request->input('existing_brand'));
        } elseif (!empty($request->input('brand'))) {
            $brand = Brand::create([
                'name' => $request->input('brand'),
            ]);
        }
        if (empty($brand)) {
            $rules['brand'] = 'required';
        }

        if ($request->input('existing_category')) {
            $category = ProductCategory::find($request->input('existing_category'));
        } elseif (!empty($request->input('category'))) {
            $category = ProductCategory::create([
                'breadcrumb' => $request->input('category'),
                'name' => $request->input('category'),
                'parent_id' => 0,
                'url_slug' => Str::slug($request->input('category')),
            ]);
        }
        if (empty($category)) {
            $rules['category'] = 'required';
        }

        $this->validate($request, $rules);

        $data = [
            'brand' => $brand->id,
            'upc' => $request->upc,
            'name' => $request->name,
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

        if ($product) {
            $product->category()->attach($category->id);
            $this->uploadProductImages($request, $product->id);
        }

        return redirect(
            route(
                'lister.newListing',
                [
                    'product' => $product->id,
                ]
            )
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

    public function uploadProductImages(Request $request, $product_id = 0)
    {
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $valid_extensions = ['jpg','jpeg','png'];
                if (! in_array(strtolower($image->getClientOriginalExtension()), $valid_extensions)) {
                    return redirect()->back()->withInput($request->input())->with('error', 'Only .jpg, .jpeg and .png is allowed extension') ;
                }

                $file_base_name = str_replace('.' . $image->getClientOriginalExtension(), '', $image->getClientOriginalName());
                $resized = Image::make($image)->resize(640, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->stream();
                $resized_thumb = Image::make($image)->resize(320, 213)->stream();

                $image_name = strtolower(time() . str_random(5) . '-' . str_slug($file_base_name)) . '.' . $image->getClientOriginalExtension();

                $imageFileName = 'uploads/images/' . $image_name;
                $imageThumbName = 'uploads/images/thumbs/' . $image_name;

                try {
                    //Upload original image
                    $is_uploaded = current_disk()->put($imageFileName, $resized->__toString(), 'public');

                    if ($is_uploaded) {
                        //Save image name into db
                        $created_img_db = ProductImage::create(['product_id' => $product_id, 'media_name' => $image_name, 'type' => 'image', 'storage' => get_option('default_storage'), 'ref' => 'product']);

                        //upload thumb image
                        current_disk()->put($imageThumbName, $resized_thumb->__toString(), 'public');
                        $img_url = media_url($created_img_db, false);
                    }
                } catch (\Exception $e) {
                    return redirect()->back()->withInput($request->input())->with('error', $e->getMessage()) ;
                }
            }
        }
    }
}
