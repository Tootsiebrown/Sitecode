<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Dashboard\CropsProductImages;
use App\Http\Controllers\Dashboard\HandlesEbayAspects;
use App\Jobs\UpdateEbayOfferInventory;
use App\Models\Brand;
use App\Models\Listing;
use App\Models\Listing\Image as ListingImage;
use App\Models\ProductCategory;
use App\Repositories\ListingsRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Wax\Core\Traits\CanUseFilters;

class AdsController extends Controller
{
    use GetsDenormalizedProductCategories;
    use CanUseFilters;
    use CropsProductImages;
    use HandlesEbayCategories;
    use HandlesEbayAspects;

    protected $repo;

    protected $optionalFields = [
        'gender' => 'Gender',
        'model_number' => 'Model Number',
        'color' => 'Color',
        'expiration_date' => 'Expiration Date',
        'dimensions' => 'Dimensions',
        'size' => 'Size',
    ];

    public function __construct(ListingsRepository $listingsRepository)
    {
        $this->repo = $listingsRepository;
    }

    public function index(Request $request)
    {
        $upc = $request->input('upc');
        $name = $request->input('name');
        $sku = $request->input('sku');
        $searchBy = $request->input('search_by');
        $featured = (bool)$request->input('featured');

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
            'dashboard.listings.index',
            [
                'title' => 'Listings',
                'upc' => $upc,
                'name' => $name,
                'searchBy' => $searchBy,
                'searchString' => $searchString,
                'listings' => $this->listingSearch(
                    $searchBy,
                    $upc,
                    $name,
                    $sku,
                    $featured
                ),
                'featuredLink' => $this->getFeaturedLink(
                    $searchBy,
                    $upc,
                    $name,
                    $sku,
                ),
            ]
        );
    }

    private function getFeaturedLink($searchBy, $upc, $name, $sku)
    {
        $parameters = [
            'featured' => 1
        ];

        switch ($searchBy) {
            case 'name':
                $parameters['search_by'] = 'name';
                $parameters['name'] = $name;
                break;
            case 'upc':
                $parameters['search_by'] = 'upc';
                $parameters['upc'] = $upc;
                break;
            case 'sku':
                $parameters['search_by'] = 'sku';
                $parameters['sku'] = $sku;
                break;
        }

        return route('dashboard.listings.index', $parameters);
    }

    private function listingSearch($searchBy, $upc, $name, $sku, $featured)
    {
        if ($featured) {
            $adQuery = Listing::featured();
        } else {
            $adQuery = (new Listing())->newQuery();
        }

        $adQuery->with(['images', 'brand']);

        if (is_null($searchBy)) {
            return $adQuery->orderBy('title', 'asc')->paginate(20);
        }

        switch ($searchBy) {
            case 'name':
                $adQuery->where('title', 'like', "%$name%");
                break;
            case 'upc':
                $adQuery->where('upc', $upc);
                break;
            case 'sku':
                $adQuery->where('id', $sku);
                break;
            default:
                throw new Exception('Invalid search method:' . $searchBy);
        }

        $ads = $adQuery
            ->orderBy('title', 'asc')
            ->paginate(20);

        switch ($searchBy) {
            case 'name':
                $ads
                    ->appends([
                        'search_by' => 'name',
                        'name' => $name,
                    ]);
                break;
            case 'upc':
                $ads
                    ->appends([
                        'search_by' => 'upc',
                        'upc' => $upc,
                    ]);
                break;
            case 'sku':
                $ads
                    ->appends([
                        'search_by' => 'sku',
                        'sku' => $sku,
                    ]);
                break;
        }

        if (request('featured')) {
            $ads->appends(['featured' => 1]);
        }

        return $ads;
    }

    public function showEdit(Request $request, $id)
    {
        $listing = Listing::withoutGlobalScopes()
            ->find($id);

        if (! $listing) {
            abort(404);
        }

        $categories = ProductCategory::where('parent_id', 0)->get()->keyBy('id');
        $children = ProductCategory::whereIn('parent_id', $categories->pluck('id'))->get()->keyBy('id');
        $grandChildren = ProductCategory::whereIn('parent_id', $children->pluck('id'))->get()->keyBy('id');

        $denormalizedCategories = $this->getDenormalizedProductCategories(
            clone $categories,
            clone $children,
            clone $grandChildren
        );

        return view('dashboard.listings.edit', [
            'listing' => $listing,
            'categoryHierarchy' => $denormalizedCategories,
            'brands' => Brand::all(),
            'categories' => $categories,
            'children' => $children,
            'grandchildren' => $grandChildren,
            'optionalFields' => $this->optionalFields,
        ]);
    }

    public function saveEdit(Request $request, $id)
    {
        $listing = Listing::withoutGlobalScopes()
            ->find($id);

        if (!$listing) {
            abort(404);
        }

        $rules = [
            'title' => 'required|max:255',
            'upc' => 'required',
            'price' => 'required|numeric|gt:0',
            'original_price' => 'required|numeric',
            'description' => 'required',
            'condition' => [
                'required',
                Rule::in(Listing::getConditions()),
            ],

            'offers_enabled' => 'boolean',
            'secret' => 'boolean',

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

            'send_to_ebay' => 'boolean',
            'send_to_ebay_at' => 'required_if:send_to_ebay,1',
            'send_to_ebay_markup' => 'required_if:send_to_ebay,1|integer|min:1',
            'ebay_category_1' => 'required_if:send_to_ebay,1',
        ];

        if ($listing->sent_to_ebay_at) {
            unset($rules['send_to_ebay_at']);
        }


        $rules = $this->addEbayAspectRequirements($request, $rules);

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
            'title' => $request->title,
            'original_price' => $request->original_price,
            'price' => $request->price,
            'condition' => $request->condition,
            'description' => $request->description,
            'features' => $request->features,
            'featured' => $request->input('featured', false),
            'shipping_weight_oz' => empty($request->input('shipping_weight_oz'))
                ? null
                : $request->input('shipping_weight_oz'),
            'offers_enabled' => $request->has('offers_enabled')
                ? $request->input('offers_enabled')
                : false,
            'secret' => $request->has('secret')
                ? $request->input('secret')
                : false,
        ];

        foreach ($this->optionalFields as $fieldName => $fieldLabel) {
            $data[$fieldName] = $request->input($fieldName);
        }

        if ($listing->type === 'set-price' && $request->input('send_to_ebay')) {
            $data['send_to_ebay'] = true;
            $data['send_to_ebay_at'] = $request->input('send_to_ebay_at');
            $data['send_to_ebay_markup'] = $request->input('send_to_ebay_markup');
            $data['ebay_categories'] = $this->getEbayCategories($request);
            $data['ebay_condition_id'] = $request->input('ebay_condition');
        } else {
            $data['send_to_ebay'] = false;
        }

        if ($listing->sent_to_ebay_at) {
            unset($data['send_to_ebay']);
            unset($data['sent_to_ebay_at']);
        }

        $listing->fill($data);
        $listing->save();

        $listing->categories()->detach();


        $listing->categories()->attach($category->id);
        if (!empty($child)) {
            $listing->categories()->attach($child->id);
        }
        if (!empty($grandchild)) {
            $listing->categories()->attach($grandchild->id);
        }

        //fresh query
        $oldImages = $listing->images()->get();

        $imageSortOrder = json_decode($request->input('imageSortOrder'));

        $this->syncListingImages(
            $listing,
            $request->input('existing_images', []),
            $request->input('deletable_images', []),
            $imageSortOrder
        );

        $this->cropImages(
            $oldImages,
            $request->input('existing_images', []),
            $request->input('existing_image_metadata', [])
        );

        $this->addProductImages(
            $listing,
            $request->input('new_images', []),
            $request->input('new_images_metadata'),
            $imageSortOrder
        );

        $this->updateEbayAspects(
            $listing,
            $request->input('ebay_aspect', []),
            $request->input('ebay_aspect_cardinality', []),
        );

        if ($listing->sent_to_ebay_at) {
            UpdateEbayOfferInventory::dispatch($listing->fresh());
        }

        return redirect(
            route(
                'dashboard.listings.showEdit',
                [
                    'id' => $listing->id,
                ]
            )
        )->with('success', 'Listing Edited.');
    }

    protected function syncListingImages(
        Listing $listing,
        array $existingImages,
        array $deletableImages,
        $imageSortOrder
    ) {
        ListingImage::whereNotIn('id', $existingImages)
            ->where('listing_id', $listing->id)
            ->delete();

        foreach ($imageSortOrder as $image) {
            if (strpos($image->id, 'existing-') === 0) {
                $imageId = substr($image->id, strlen('existing-'));
                ListingImage::where('id', $imageId)
                    ->update(['sort_id' => $image->position]);
            }
        }

        // but delete any images that were uploaded and then discarded.
        foreach ($deletableImages as $deletableImage) {
            current_disk()->delete(ListingImage::getDiskPath() . $deletableImage);
            current_disk()->delete(ListingImage::getDiskPath() . 'thumbs/' . $deletableImage);
            current_disk()->delete(ListingImage::getDiskPath() . 'cropped/' . $deletableImage);
            current_disk()->delete(ListingImage::getDiskPath() . 'cropped/thumbs/' . $deletableImage);
        }
    }

    protected function addProductImages(
        Listing $listing,
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

            $createdImage = ListingImage::create([
                'listing_id' => $listing->id,
                'media_name' => $newImage,
                'disk' => get_option('default_storage'),
                'metadata' => $newImagesMeta[$newImage] ?? '',
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

    public function favoriteAds()
    {
        $title = trans('app.favourite_ads');

        $user = Auth::user();
        $ads = $user->favourite_ads()->with('city', 'country', 'state')->orderBy('id', 'desc')->paginate(20);

        return view('dashboard.favourite_ads', compact('title', 'ads'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Search ads
     */

    public function search(Request $request)
    {
        $this->syncFilters($request);
        $perPage = 12;

        $title = null;

        $categoryId = $request->input('category');
        if ($categoryId) {
            $category = ProductCategory::find($categoryId);
            if ($category && ($category->secret || $category->descendent_of_secret)) {
                $this->repo->allowSecret();
            }
        }
        $paginatedListings = $this->repo->getPaginated($perPage);

        $filterOptions = $this->repo->getFilterOptions();

        return view('pages.search', [
            'listings' => $paginatedListings,
            'filterOptions' => $filterOptions,
            'filterValues' => $this->getFilterValuesFromRequest($request),
            'title' => 'Search Results'
        ]);
    }


    /**
     * @param $slug
     * @return mixed
     */
    public function singleAuction($id, $slug)
    {
        $listing = Listing::withoutGlobalScope('activeIfAuction')
            ->withoutGlobalScope('withInventory')
            ->withoutGlobalScope('notSecret')
            ->find($id);

        if (! $listing) {
            return view('error_404');
        }

        if (! $listing->is_published()) {
            if (Auth::check()) {
                $user_id = Auth::user()->id;
                if ($user_id != $listing->user_id) {
                    return view('error_404');
                }
            } else {
                return view('error_404');
            }
        } else {
            $listing->view = $listing->view + 1;
            $listing->save();
        }

        $title = $listing->title;

        //Get Related Ads, add [->whereCountryId($listing->country_id)] for more specific results
        $relatedListings = collect(); //Ad::active()->whereCategoryId($listing->category_id)->where('id', '!=', $listing->id)->with('category', 'city', 'state', 'country', 'sub_category')->limit($limit_regular_ads)->orderByRaw('RAND()')->get();

        return view('single-listing', [
            'listing' => $listing,
            'title' => $title,
            'relatedListings' => $relatedListings,
            'alreadyHasOffer' => $this->alreadyHasOfferOn($listing),
        ]);
    }

    public function singleAuctionRedirect($id)
    {
        $listing = Listing::withoutGlobalScope('activeIfAuction')
            ->withoutGlobalScope('withInventory')
            ->withoutGlobalScope('notSecret')
            ->find($id);

        if (! $listing) {
            return view('error_404');
        }

        return redirect()->route(
            'singleListing',
            ['id' => $listing->id, 'slug' => $listing->slug]
        );
    }

    protected function alreadyHasOfferOn(Listing $listing)
    {
        if (! Auth::check()) {
            return false;
        }

        $pendingCount = Auth::user()->offers()->forListing($listing)
            ->status('pending')->count();
        $acceptedCount = Auth::user()->offers()->forListing($listing)
            ->status('accepted')->count();
        $counterAcceptedCount = Auth::user()->offers()->forListing($listing)
            ->status('counter_accepted')->count();

        if ($pendingCount + $acceptedCount + $counterAcceptedCount > 0) {
            return true;
        }

        return false;
    }

    public function showSortFeatured()
    {
        $listings = Listing::active()->featured()->get();

        return view('dashboard.listings.sort-featured', [
            'listings' => $listings,
        ]);
    }

    public function saveSortFeatured(Request $request)
    {
        $json = $request->input('listing_order');

        $listingOrder = json_decode($json);

        foreach ($listingOrder as $listingPosition) {
            Listing::where('id', $listingPosition->id)
                ->update(['featured_sort_id' => $listingPosition->position]);
        }

        return redirect()
            ->back()
            ->with('success', 'New Order Saved');
    }
}
