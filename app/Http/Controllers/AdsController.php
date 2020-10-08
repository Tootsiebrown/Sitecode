<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Listing\Image as ListingImage;
use App\Brand;
use App\Category;
use App\City;
use App\Comment;
use App\Country;
use App\Media;
use App\Payment;
use App\ProductCategory;
use App\Repositories\ListingsRepository;
use App\State;
use App\Sub_Category;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Wax\Core\Traits\CanUseFilters;

class AdsController extends Controller
{
    use GetsDenormalizedProductCategories;
    use CanUseFilters;

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
        $listing = Listing::find($id);

        if (! $listing) {
            abort(404);
        }


        return view('dashboard.listings.edit', [
            'listing' => $listing,
            'categoryHierarchy' => $this->getDenormalizedProductCategories(),
            'brands' => Brand::all(),
            'categories' => ProductCategory::where('parent_id', 0)->get(),
            'children' => ProductCategory::whereIn('parent_id', function ($query) {
                $query->select('id')
                    ->from('product_categories')
                    ->where('parent_id', 0);
            })->get(),
            'grandchildren' => collect(),
            'optionalFields' => $this->optionalFields,

        ]);
    }

    public function saveEdit(Request $request, $id)
    {
        $listing = Listing::find($id);

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
        ];

        foreach ($this->optionalFields as $fieldName => $fieldLabel) {
            $data[$fieldName] = $request->input($fieldName);
        }

        $listing->fill($data);
        $listing->save();

        $listing->categories()->detach();

        if ($listing) {
            $listing->categories()->attach($category->id);
            if (!empty($child)) {
                $listing->categories()->attach($child->id);
            }
            if (!empty($grandchild)) {
                $listing->categories()->attach($grandchild->id);
            }
            $this->syncListingImages(
                $listing,
                $request->input('existing_images', []),
                $request->input('deletable_images', [])
            );
            $this->addProductImages($listing, $request->input('new_images', []));
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

    protected function syncListingImages(Listing $listing, array $existingImages, array $deletableImages)
    {
        // don't delete images files for ProductImages in the database...
        // product could have been cloned, and that will cause problems.
        ListingImage::whereNotIn('id', $existingImages)
            ->where('listing_id', $listing->id)
            ->delete();

        // but delete any images that were uploaded and then discarded.
        foreach ($deletableImages as $deletableImage) {
            current_disk()->delete(ListingImage::getDiskPath() . $deletableImage);
            current_disk()->delete(ListingImage::getDiskPath() . 'thumbs/' . $deletableImage);
        }
    }

    protected function addProductImages(Listing $listing, array $newImages)
    {
        foreach ($newImages as $newImage) {
            $created_img_db = ListingImage::create([
                'listing_id' => $listing->id,
                'media_name' => $newImage,
                'disk' => get_option('default_storage'),
            ]);
        }
    }

    public function favoriteAds()
    {
        $title = trans('app.favourite_ads');

        $user = Auth::user();
        $ads = $user->favourite_ads()->with('city', 'country', 'state')->orderBy('id', 'desc')->paginate(20);

        return view('dashboard.favourite_ads', compact('title', 'ads'));
    }



//    public function uploadAdsImage(Request $request, $ad_id = 0)
//    {
//        $user_id = 0;
//
//        if (Auth::check()) {
//            $user_id = Auth::user()->id;
//        }
//
//        if ($request->hasFile('images')) {
//            $images = $request->file('images');
//            foreach ($images as $image) {
//                $valid_extensions = ['jpg','jpeg','png'];
//                if (! in_array(strtolower($image->getClientOriginalExtension()), $valid_extensions)) {
//                    return redirect()->back()->withInput($request->input())->with('error', 'Only .jpg, .jpeg and .png is allowed extension') ;
//                }
//
//                $file_base_name = str_replace('.' . $image->getClientOriginalExtension(), '', $image->getClientOriginalName());
//                $resized = Image::make($image)->resize(640, null, function ($constraint) {
//                    $constraint->aspectRatio();
//                })->stream();
//                $resized_thumb = Image::make($image)->resize(320, 213)->stream();
//
//                $image_name = strtolower(time() . str_random(5) . '-' . str_slug($file_base_name)) . '.' . $image->getClientOriginalExtension();
//
//                $imageFileName = 'uploads/images/' . $image_name;
//                $imageThumbName = 'uploads/images/thumbs/' . $image_name;
//
//                try {
//                    //Upload original image
//                    $is_uploaded = current_disk()->put($imageFileName, $resized->__toString(), 'public');
//
//                    if ($is_uploaded) {
//                        //Save image name into db
//                        $created_img_db = Media::create(['user_id' => $user_id, 'ad_id' => $ad_id, 'media_name' => $image_name, 'type' => 'image', 'storage' => get_option('default_storage'), 'ref' => 'ad']);
//
//                        //upload thumb image
//                        current_disk()->put($imageThumbName, $resized_thumb->__toString(), 'public');
//                        $img_url = media_url($created_img_db, false);
//                    }
//                } catch (\Exception $e) {
//                    return redirect()->back()->withInput($request->input())->with('error', $e->getMessage()) ;
//                }
//            }
//        }
//    }
    /**
     * @param Request $request
     * @return array
     */

//    public function deleteMedia(Request $request)
//    {
//        abort(400);
//        $media_id = $request->media_id;
//        $media = Media::find($media_id);
//
//        $storage = Storage::disk($media->storage);
//        if ($storage->has('uploads/images/' . $media->media_name)) {
//            $storage->delete('uploads/images/' . $media->media_name);
//        }
//
//        if ($media->type == 'image') {
//            if ($storage->has('uploads/images/thumbs/' . $media->media_name)) {
//                $storage->delete('uploads/images/thumbs/' . $media->media_name);
//            }
//        }
//
//        $media->delete();
//        return ['success' => 1, 'msg' => trans('app.media_deleted_msg')];
//    }

    /**
     * @param Request $request
     * @return array
     */
//    public function featureMediaCreatingAds(Request $request)
//    {
//        $user_id = Auth::user()->id;
//        $media_id = $request->media_id;
//
//        Media::whereUserId($user_id)->whereAdId(0)->whereRef('ad')->update(['is_feature' => '0']);
//        Media::whereId($media_id)->update(['is_feature' => '1']);
//
//        return ['success' => 1, 'msg' => trans('app.media_featured_msg')];
//    }

    /**
     * @return mixed
     */

//    public function appendMediaImage()
//    {
//        $user_id = Auth::user()->id;
//        $ads_images = Media::whereUserId($user_id)->whereAdId(0)->whereRef('ad')->get();
//
//        return view('dashboard.append_media', compact('ads_images'));
//    }

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

        $paginatedListings = $this->repo->getPaginated($perPage);

        $filterOptions = $this->repo->getFilterOptions();

        $brand = null;
        if (request('brand')) {
            $brand = Brand::find(request('brand'));
        }

        return view('pages.search', [
            'listings' => $paginatedListings,
            'filterOptions' => $filterOptions,
            'filterValues' => $this->getFilterValuesFromRequest($request),
            'brand' => $brand,
            'title' => 'Search Results'
        ]);

        //Sort by filter
        // maybe add this back in at some point
//        if (request('sortBy')) {
//            switch (request('sortBy')) {
//                case 'price_high_to_low':
//                    $listings = $listings->orderBy('price', 'desc');
//                    break;
//                case 'price_low_to_high':
//                    $listings = $listings->orderBy('price', 'asc');
//                    break;
//                case 'latest':
//                    $listings = $listings->orderBy('id', 'desc');
//                    break;
//            }
//        } else {
//            $listings = $listings->orderBy('id', 'desc');
//        }
    }


    /**
     * @param $slug
     * @return mixed
     */
    public function singleAuction($id, $slug)
    {
        $listing = Listing::withoutGlobalScope('activeIfAuction')->find($id);

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

        return view('single-listing', compact('listing', 'title', 'relatedListings'));
    }

//    public function switchGridListView(Request $request)
//    {
//        session(['grid_list_view' => $request->grid_list_view]);
//    }

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
