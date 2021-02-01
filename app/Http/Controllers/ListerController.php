<?php

namespace App\Http\Controllers;

use App\Gateways\DatafinitiGateway;
use App\Http\Controllers\Dashboard\CropsProductImages;
use App\Http\Controllers\Dashboard\HandlesEbayAspects;
use App\Models\Brand;
use App\Models\Listing;
use App\Models\Listing\Image as ListingImage;
use App\Models\Listing\Item;
use App\Models\Product;
use App\Models\ProductCategory;
use App\ProductImage;
use Exception;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ListerController extends Controller
{
    use GetsDenormalizedProductCategories;
    use CropsProductImages;
    use HandlesEbayCategories;
    use HandlesEbayAspects;

    protected $datafinitiGateway;

    protected $optionalFields = [
        'gender' => 'Gender',
        'model_number' => 'Model Number',
        'color' => 'Color',
        'expiration_date' => 'Expiration Date',
        'dimensions' => 'Dimensions',
        'size' => 'Size',
    ];

    public function __construct(DatafinitiGateway $datafinitiGateway)
    {
        $this->datafinitiGateway = $datafinitiGateway;
    }

    public function index(Request $request)
    {
        $upc = $request->input('upc');
        $name = $request->input('name');
        $sku = $request->input('sku');
        $searchBy = $request->input('search_by');
        $datafinitiUpc = $request->input('datafiniti_upc');

        switch ($searchBy) {
            case 'name':
                $searchString = $name;
                break;
            case 'upc':
                $searchString = $upc;
                break;
            case 'sku':
                $searchString = $sku;
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
                    $name,
                    $sku,
                ),
                'datafinitiUpc' => $datafinitiUpc,
                'datafinitiProfiles' => $this->datafinitiSearch($datafinitiUpc),
            ]
        );
    }

    private function productSearch($searchBy, $upc, $name, $sku)
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
            case 'sku':
                if (empty($sku)) {
                    return collect();
                }
                $productsQuery = Product::where('id', $sku);
                break;
            default:
                throw new Exception('Invalid search method:' . $searchBy);
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

    public function productForm(Request $request)
    {
        $newBrand = null;

        if (null !== $request->input('from_profile')) {
            [
                $product,
                $newBrand,
            ] = $this->newProductFromDatafiniti(
                $request->input('upc'),
                $request->input('from_profile')
            );

            $action = 'new';
        } elseif (null != $request->input('product')) {
            $product = Product::find($request->input('product'));

            if (! $product) {
                abort(404);
            }

            $action = $request->input('action', 'new') == 'edit'
                ? 'edit'
                : 'new';
        } else {
            $product = new Product([
                'upc' => $request->input('upc'),
                'name' => $request->input('name')
            ]);

            $action = 'new';
        }

        return view('dashboard.lister.product_form', [
            'categoryHierarchy' => $this->getDenormalizedProductCategories(),
            'brands' => Brand::all(),
            'categories' => ProductCategory::where('parent_id', 0)->get(),
            'children' => ProductCategory::whereIn('parent_id', function ($query) {
                $query->select('id')
                    ->from('product_categories')
                    ->where('parent_id', 0);
            })->get(),
            'grandchildren' => collect(),
            'product' => $product ?? null,
            'newBrand' => $newBrand,
            'action' => $action,
            'optionalFields' => $this->optionalFields,
        ]);
    }



    protected function newProductFromDatafiniti($upc, $profileId)
    {
        $newBrand = null;
        $product = new Product();
        $datafinitProducts = $this->datafinitiGateway->barCodeSearch($upc);
        $datafinitiProduct = $datafinitProducts[$profileId];

        if (!empty($datafinitiProduct['prices'])) {
            $product->original_price = str_replace(',', '', $datafinitiProduct['prices'][0]['amountMax']);
        }
        if (!empty($datafinitiProduct['descriptions'])) {
            $product->description = implode(' ', $datafinitiProduct['descriptions']);
        }

        if (!empty($datafinitiProduct['brand'])) {
            $existingBrand = Brand::where('name', 'like', $datafinitiProduct['brand'])
                ->first();

            if ($existingBrand) {
                $product->brand_id = $existingBrand->id;
            } else {
                $newBrand = $datafinitiProduct['brand'];
            }
        }

        $productFeatures = '';
        if (!empty($datafinitiProduct['features'])) {
            $productFeatures = collect($datafinitiProduct['features'])->where('key', 'Product Features')->first();
            $productFeatures = $productFeatures['value'] ?? '';
            if (!empty($productFeatures)) {
                $productFeatures = '<ul><li>' . implode('</li><li>', $productFeatures) . '</li></ul>';
            }
        }
        $product->features = $productFeatures;

        return [
            $product,
            $newBrand,
        ];
    }

    public function cloneProduct(Request $request)
    {
        $originalProduct = Product::find($request->input('product'));

        if (! $originalProduct) {
            abort(404);
        }

        $clone = $originalProduct->replicate();
        $clone->save();

        foreach ($originalProduct->categories as $category) {
            $clone->categories()->attach($category->id);
        }

        foreach ($originalProduct->images as $image) {
            $clone->images()->save($image->replicate());
        }

        return redirect(route('lister.productForm', ['product' => $clone->id, 'action=edit']));
    }

    public function getCategoryChildren(Request $request)
    {
        $category_id = $request->category_id;
        $children = ProductCategory::where('parent_id', $category_id)->select(['id', 'name'])->get();
        return $children;
    }

    public function saveProduct(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'upc' => 'required',
            'price' => 'required|numeric|gt:0',
            'original_price' => 'required|numeric',
            'description' => 'required',
            'condition' => [
                'required',
                Rule::in(Product::getConditions()),
            ],

            'offers_enabled' => 'boolean',

            'brand_id' => 'exclude_if:brand_id,new|required|exists:brands,id',
            'brand' => 'exclude_unless:brand_id,new|required',

            'category_id'  => 'exclude_if:category_id,new|required|exists:product_categories,id',
            'new_category' => 'exclude_unless:category_id,new|required|unique,product_categories,name',

            'child_category_id' => [
                'exclude_if:child_category_id,new',
//                Rule::exists('product_categories,id')->where(function($query) use ($request) {
//                    $query->where('parent_id', $request->input('category_id'));
//                }),
            ],
            'new_child_category' => 'exclude_unless:child_category_id,new|unique,product_categories,name',



            'grandchild_category_id' => [
                'exclude_if:grandchild_category_id,new',
//                Rule::exists('product_categories,id')->where(function($query) use ($request) {
//                    $query->where('parent_id', $request->input('child_category_id'));
//                }),
            ],
            'new_grandchild_category' => 'exclude_unless:child_category_id,new|unique,product_categories,name',
            'shipping_weight_oz' => 'numeric|min:1',
        ];

        $this->validate($request, $rules);

        if ($request->input('category_id') && $request->input('category_id') !== 'new') {
            $category = ProductCategory::find($request->input('category_id'));
        } elseif ($request->has('new_category')) {
            $category = ProductCategory::create([
                'breadcrumb' => $request->input('new_category'),
                'name' => $request->input('new_category'),
                'parent_id' => 0,
                'url_slug' => Str::slug($request->input('new_category')),
            ]);
        }

        if ($request->input('child_category_id') && $request->input('child_category_id') !== 'new') {
            $child = ProductCategory::find($request->input('child_category_id'));
        } elseif (!empty($request->input('new_child_category'))) {
            $child = ProductCategory::create([
                'breadcrumb' => $category->name . ' » ' . $request->input('new_child_category'),
                'name' => $request->input('new_child_category'),
                'parent_id' => $category->id,
                'url_slug' => Str::slug($request->input('new_child_category')),
            ]);
        }

        if ($request->input('grandchild_category_id') && $request->input('grandchild_category_id') !== 'new') {
            $grandchild = ProductCategory::find($request->input('grandchild_category_id'));
        } elseif (!empty($request->input('new_grandchild_category'))) {
            $grandchild = ProductCategory::create([
                'breadcrumb' => $category->name . ' » ' . $child->name . ' » ' . $request->input('new_grandchild_category'),
                'name' => $request->input('new_grandchild_category'),
                'parent_id' => $child->id,
                'url_slug' => Str::slug($request->input('new_grandchild_category')),
            ]);
        }

        if ($request->input('brand_id') && $request->input('brand_id') !== 'new') {
            $brand = Brand::find($request->input('brand_id'));
        } elseif (!empty($request->input('new_brand'))) {
            $brand = Brand::create([
                'name' => $request->input('new_brand'),
            ]);
        }

        $data = [
            'brand_id' => $brand->id,
            'upc' => $request->upc,
            'name' => $request->name,
            'original_price' => $request->original_price,
            'price' => $request->price,
            'condition' => $request->condition,
            'description' => $request->description,
            'features' => $request->features,
            'shipping_weight_oz' => empty($request->input('shipping_weight_oz'))
                ? null
                : $request->input('shipping_weight_oz'),
            'offers_enabled' => $request->has('offers_enabled')
                ? $request->input('offers_enabled')
                : false,
        ];

        if ($request->input('redone')) {
            $data['redone_at'] = Carbon::now()->toDateTimeString();
            $data['redone_by_user_id'] = Auth::user()->id;
        } else {
            $data['redone_at'] = null;
            $data['redone_by_user_id'] = null;
        }

        foreach ($this->optionalFields as $fieldName => $fieldLabel) {
            $data[$fieldName] = $request->input($fieldName);
        }

        if ($request->input('action') === 'edit') {
            $product = Product::find($request->input('product_id'));
            $product->fill($data);
            $product->save();
        } else {
            $product = Product::create($data);
        }

        $product->categories()->detach();

        if ($product) {
            $product->categories()->attach($category->id);
            if (!empty($child)) {
                $product->categories()->attach($child->id);
            }
            if (!empty($grandchild)) {
                $product->categories()->attach($grandchild->id);
            }

            //fresh query
            $oldImages = $product->images()->get();
            $imageSortOrder = json_decode($request->input('imageSortOrder'));

            $this->syncProductImages(
                $product,
                $request->input('existing_images', []),
                $request->input('deletable_images', []),
                $imageSortOrder,
            );

            $this->cropImages(
                $oldImages,
                $request->input('existing_images', []),
                $request->input('existing_image_metadata', [])
            );

            $this->addProductImages(
                $product,
                $request->input('new_images', []),
                $request->input('new_images_metadata', []),
                $imageSortOrder
            );
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

    protected function syncProductImages(
        Product $product,
        array $existingImages,
        array $deletableImages,
        $imageSortOrder
    ) {
        ProductImage::whereNotIn('id', $existingImages)
            ->where('product_id', $product->id)
            ->delete();

        foreach ($imageSortOrder as $image) {
            if (strpos($image->id, 'existing-') === 0) {
                $imageId = substr($image->id, strlen('existing-'));
                ProductImage::where('id', $imageId)
                    ->update(['sort_id' => $image->position]);
            }
        }

        foreach ($deletableImages as $deletableImage) {
            current_disk()->delete(ProductImage::getDiskPath() . $deletableImage);
            current_disk()->delete(ProductImage::getDiskPath() . 'thumbs/' . $deletableImage);
        }
    }

    protected function addProductImages(
        Product $product,
        array $newImages,
        $newImagesMeta,
        $imageSortOrder
    ) {
        $createdImages = collect();
        $createdImagesMeta = [];
        $sortOrder = [];

        foreach ($imageSortOrder as $item) {
            if (strpos($item->id, 'new-') !== 0) {
                continue;
            }

            $filename = substr($item->id, strlen('new-'));
            $sortOrder[$filename] = $item->position;
        }

        $nextSortId = count($imageSortOrder) + 1;

        foreach ($newImages as $newImage) {
            if (!empty($sortOrder[$newImage])) {
                $imageSortId = $sortOrder[$newImage];
            } else {
                $imageSortId = $nextSortId;
                $nextSortId++;
            }

            $createdImage = ProductImage::create([
                'product_id' => $product->id,
                'media_name' => $newImage,
                'disk' => get_option('default_storage'),
                'sort_id' => $imageSortId,
            ]);

            $createdImages->push($createdImage);
            $createdImagesMeta[$createdImage->id] = $newImagesMeta[$newImage];
        }

        $this->cropImages(
            $createdImages,
            $createdImages->pluck('id')->values()->toArray(),
            $createdImagesMeta
        );
    }



    public function newListing(Request $request)
    {
        $product = Product::find($request->input('product'));

        if (!$product) {
            return back()->with('error', 'Product not found');
        }

        return view('dashboard.lister.create_listing', [
            'product' => $product,
            'optionalFields' => $this->optionalFields,
        ]);
    }

    public function saveListing(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
            'bid_deadline' => 'required_if:type,auction',
            'product_id' => 'exists:products,id',
            'type' => 'required|in:auction,set-price',
            'quantity' => 'integer|required_if:type,set-price',
            'price' => 'required|numeric',
            'offers_enabled' => 'boolean',
            'secret' => 'boolean',
            'send_to_ebay' => 'boolean',
            'send_to_ebay_at' => 'required_if:send_to_ebay,1',
            'send_to_ebay_markup' => 'required_if:send_to_ebay,1|integer|min:1',
            'ebay_category_1' => 'required_if:send_to_ebay,1',
        ];

        foreach ($this->optionalFields as $fieldName => $fieldLabel) {
            $rules[$fieldName] = 'max:255';
        }

        $rules = $this->addEbayAspectRequirements($request, $rules);

        $this->validate($request, $rules);

        $product = Product::find($request->product_id);

        $ad = DB::transaction(function () use ($request, $product) {
            $data = [
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'expired_at' => $request->input('type') == 'auction'
                    ? $request->bid_deadline . ':00'
                    : null,

                'type' => $request->input('type'),
                'status' => "1", // published automatically

                // really just for historical purposes
                'product_id' => $product->id,

                // copy over from the product
                'description' => $product->description,
                'features' => $product->features,
                'brand_id' => $product->brand_id,
                'upc' => $product->upc,
                'price' => $request->input('price'),
                'meta_description' => $product->meta_description,
                'meta_keywords' => $product->meta_keywords,
                'original_price' => $product->original_price,
                'condition' => $product->condition,
                'shipping_weight_oz' => $product->shipping_weight_oz,
                'offers_enabled' => $request->input('offers_enabled', false),
                'secret' => $request->input('secret', false),
            ];

            foreach ($this->optionalFields as $fieldName => $fieldLabel) {
                $data[$fieldName] = $request->input($fieldName, '');
            }

            if ($data['type'] === 'set-price' && $request->input('send_to_ebay')) {
                $data['send_to_ebay'] = true;
                $data['send_to_ebay_at'] = $request->input('send_to_ebay_at');
                $data['send_to_ebay_markup'] = $request->input('send_to_ebay_markup');
                $data['ebay_categories'] = $this->getEbayCategories($request);
                $data['ebay_condition_id'] = $request->input('ebay_condition');
            } else {
                $data['send_to_ebay'] = false;
            }

            $ad = Listing::create($data);

            $quantity = $request->input('type') == 'auction'
                ? 1
                : $request->input('quantity');
            $listingItems = [];
            for ($i = 1; $i <= $quantity; $i++) {
                $listingItems[] = ['listing_id' => $ad->id];
            }

            Item::insert($listingItems);

            $product
                ->images
                ->each(function ($image) use ($ad) {
                    ListingImage::create([
                        'listing_id' => $ad->id,
                        'media_name' => $image->media_name,
                        'featured' => $image->featured,
                        'disk' => $image->disk,
                        'metadata' => $image->metadata,
                    ]);

                    $copies = [
                        '',
                        'thumbs/',
                        'cropped/',
                        'cropped/thumbs/',

                    ];

                    foreach ($copies as $copy) {
                        if (! Storage::disk($image->disk)->exists($image::getDiskPath() . $copy . $image->media_name)) {
                            continue;
                        }

                        (new Filesystem())->copy(
                            Storage::disk($image->disk)->path($image::getDiskPath() . $copy . $image->media_name),
                            Storage::disk($image->disk)->path(ListingImage::getDiskPath() . $copy . $image->media_name)
                        );
                    }
                });

            $ad->categories()->attach(
                $product
                    ->categories
                    ->pluck('id')
            );

            $this->updateEbayAspects(
                $ad,
                $request->input('ebay_aspects', []),
                $request->input('ebay_manual_aspects', []),
                $request->input('ebay_aspect_cardinality', []),
            );


            return $ad;
        }, 3);


        return redirect(route('lister.finished', ['id' => $ad->id]));
    }

    public function listingFinished($id)
    {
        $listing = Listing::withoutGlobalScopes()->find($id);

        if (!$listing) {
            abort(404);
        }

        return view('dashboard.lister.finished', ['listing' => $listing]);
    }

    public function uploadImage(Request $request)
    {
        if (! $request->hasFile('image')) {
            abort(400);
        }

        $images = $request->file('image');
        if (!is_array($images)) {
            $images = [$images];
        }

        $valid_extensions = ['jpg','jpeg','png'];
        $returnImages = [];

        foreach ($images as $image) {
            if (!in_array(strtolower($image->getClientOriginalExtension()), $valid_extensions)) {
                return response()
                    ->json(
                        [
                            'success' => false,
                            'errors' => 'Only .jpg, .jpeg and .png is allowed extension',
                        ],
                        422,
                    );
            }

            $file_base_name = str_replace('.' . $image->getClientOriginalExtension(), '', $image->getClientOriginalName());
            $resized = Image::make($image)
                ->resize(2000, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->orientate()
                ->stream();
            $resized_thumb = Image::make($image)
                ->resize(320, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->orientate()
                ->stream();

            $imageName = strtolower(time() . str_random(5) . '-' . str_slug($file_base_name)) . '.' . $image->getClientOriginalExtension();

            switch (request('type')) {
                case 'listing':
                    $imageFileName = ListingImage::getDiskPath() . $imageName;
                    $imageThumbName = ListingImage::getDiskPath() . 'thumbs/' . $imageName;
                    break;
                case 'product':
                    $imageFileName = ProductImage::getDiskPath() . $imageName;
                    $imageThumbName = ProductImage::getDiskPath() . 'thumbs/' . $imageName;
                    break;
                default:
                    throw new Exception('"' . request('type') . '" is not a supported upload type.');
            }


            try {
                current_disk()->put($imageFileName, $resized->__toString(), 'public');
                current_disk()->put($imageThumbName, $resized_thumb->__toString(), 'public');
            } catch (Exception $e) {
                Log::info($e);
                return response()
                    ->json(
                        [
                            'success' => false,
                            'error' => $e->getMessage(),
                        ],
                        422
                    );
            }

            $returnImages[] = [
                'filename' => $imageName,
                'url' => Storage::url($imageFileName),
            ];
        }

        return response()
            ->json(
                [
                    'success' => true,
                    'images' => $returnImages
                ]
            );
    }
}
