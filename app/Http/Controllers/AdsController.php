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

class AdsController extends Controller
{
    use GetsDenormalizedProductCategories;

    protected $optionalFields = [
        'gender' => 'Gender',
        'model_number' => 'Model Number',
        'color' => 'Color',
        'expiration_date' => 'Expiration Date',
        'dimensions' => 'Dimensions',
        'size' => 'Size',
    ];

    public function index(Request $request)
    {
        $upc = $request->input('upc');
        $name = $request->input('name');
        $sku = $request->input('sku');
        $searchBy = $request->input('search_by');

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
                ),
            ]
        );
    }

    private function listingSearch($searchBy, $upc, $name, $sku)
    {
        if (is_null($searchBy)) {
            return collect();
        }

        switch ($searchBy) {
            case 'name':
                if (empty($name)) {
                    return collect();
                }
                $adQuery = Listing::where('title', 'like', "%$name%");
                break;
            case 'upc':
                if (empty($upc)) {
                    return collect();
                }
                $adQuery = Listing::where('upc', $upc);
                break;
            case 'sku':
                if (empty($sku)) {
                    return collect();
                }
                $adQuery = Listing::where('id', $sku);
                break;
            default:
                throw new Exception('Invalid search method:' . $searchBy);
        }

        return $adQuery
            ->orderBy('title', 'asc')
            ->paginate(20);
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
            'price' => 'required|numeric',
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

    public function adminPendingAds()
    {
        $title = trans('app.pending_ads');
        $ads = Listing::with('city', 'country', 'state')->whereStatus('0')->orderBy('id', 'desc')->paginate(20);

        return view('dashboard.all_ads', compact('title', 'ads'));
    }

    public function favoriteAds()
    {
        $title = trans('app.favourite_ads');

        $user = Auth::user();
        $ads = $user->favourite_ads()->with('city', 'country', 'state')->orderBy('id', 'desc')->paginate(20);

        return view('dashboard.favourite_ads', compact('title', 'ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('app.post_an_ad');
        $categories = Category::orderBy('category_name', 'asc')->get();
        $countries = Country::all();

        $previous_states = State::where('country_id', old('country'))->get();
        $previous_cities = City::where('state_id', old('state'))->get();

        return view('create_ad', compact('title', 'categories', 'countries', 'previous_states', 'previous_cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
        }

        $ads_price_plan = get_option('ads_price_plan');

        if ($request->category) {
            $sub_category = Category::find($request->category);
        }

        $rules = [
            'category'          => 'required',
            'ad_title'          => 'required',
            'ad_description'    => 'required',
            'country'           => 'required',
            'seller_name'       => 'required',
            'seller_email'      => 'required',
            'seller_phone'      => 'required',
            'address'           => 'required',
        ];

        if ($ads_price_plan != 'all_ads_free') {
            $rules['price_plan'] = 'required';
        }

        if ($request->category) {
            if ($sub_category->category_type == 'auction') {
                $rules['bid_deadline'] = 'required';
            }
        }

        //reCaptcha
        if (get_option('enable_recaptcha_post_ad') == 1) {
            $rules['g-recaptcha-response'] = 'required';
        }

        $this->validate($request, $rules);

        if (get_option('enable_recaptcha_post_ad') == 1) {
            $secret = get_option('recaptcha_secret_key');
            $gRecaptchaResponse = $request->input('g-recaptcha-response');
            $remoteIp = $request->ip();

            $recaptcha = new \ReCaptcha\ReCaptcha($secret);
            $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
            if (! $resp->isSuccess()) {
                return redirect()->back()->with('error', 'reCAPTCHA is not verified');
            }
        }

        $title = $request->ad_title;
        $slug = unique_slug($title);

        $is_negotialble = $request->negotiable ? $request->negotiable : '0';
        $brand_id = $request->brand ? $request->brand : 0;
        $mark_ad_urgent = $request->mark_ad_urgent ? $request->mark_ad_urgent : '0';
        $video_url = $request->video_url ? $request->video_url : '';

        $data = [
            'title'             => $request->ad_title,
            'slug'              => $slug,
            'description'       => $request->ad_description,
            'category_id'       => $sub_category->category_id,
            'sub_category_id'   => $request->category,
            'brand_id'          => $brand_id,
            'type'              => $request->type,
            'ad_condition'      => $request->condition,
            'price'             => $request->price,
            'is_negotiable'     => $is_negotialble,

            'seller_name'       => $request->seller_name,
            'seller_email'      => $request->seller_email,
            'seller_phone'      => $request->seller_phone,
            'country_id'        => $request->country,
            'state_id'          => $request->state,
            'city_id'           => $request->city,
            'address'           => $request->address,
            'video_url'         => $video_url,
            'category_type'     => 'classifieds',
            'price_plan'        => $request->price_plan,
            'mark_ad_urgent'    => $mark_ad_urgent,
            'status'            => '0',
            'user_id'           => $user_id,
            'latitude'          => $request->latitude,
            'longitude'         => $request->longitude,
        ];

        if ($sub_category->category_type == 'auction') {
            $data['category_type']  = 'auction';
            $data['expired_at']     = $request->bid_deadline;
        }
        //Check ads moderation settings
        if (get_option('ads_moderation') == 'direct_publish') {
            $data['status'] = '1';
        }

        //if price_plan not in post data, then set a default value, although mysql will save it as enum first value
        if (! $request->price_plan) {
            $data['price_plan'] = 'regular';
        }

        $created_ad = Listing::create($data);

        /**
         * iF add created
         */
        if ($created_ad) {
            //Attach all unused media with this ad
            $this->uploadAdsImage($request, $created_ad->id);
            /**
             * Payment transaction login here
             */
            $ads_price = get_ads_price($created_ad->price_plan);
            if ($mark_ad_urgent) {
                $ads_price = $ads_price + get_option('urgent_ads_price');
            }

            if ($ads_price) {
                //Insert checkout Logic

                $transaction_id = 'tran_' . time() . str_random(6);
                // get unique recharge transaction id
                while (( Payment::whereLocalTransactionId($transaction_id)->count() ) > 0) {
                    $transaction_id = 'reid' . time() . str_random(5);
                }
                $transaction_id = strtoupper($transaction_id);

                $currency = get_option('currency_sign');
                $payments_data = [
                    'ad_id'     => $created_ad->id,
                    'user_id'   => $user_id,
                    'amount'    => $ads_price,
                    'payment_method'    => $request->payment_method,
                    'status'    => 'initial',
                    'currency'  => $currency,
                    'local_transaction_id'  => $transaction_id
                ];
                $created_payment = Payment::create($payments_data);

                return redirect(route('payment_checkout', $created_payment->local_transaction_id));
            }

            if (Auth::check()) {
                return redirect(route('pending_ads'))->with('success', trans('app.ad_created_msg'));
            }
            return back()->with('success', trans('app.ad_created_msg'));
        }


        //dd($request->input());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $title = trans('app.edit_ad');
        $ad = Listing::find($id);

        if (!$ad) {
            return view('dashboard.error.error_404');
        }

        if (! $user->isAdmin()) {
            if ($ad->user_id != $user_id) {
                return view('dashboard.error.error_404');
            }
        }

        $countries = Country::all();

        $previous_states = State::where('country_id', $ad->country_id)->get();
        $previous_cities = City::where('state_id', $ad->state_id)->get();

        return view('dashboard.edit_ad', compact('title', 'countries', 'ad', 'previous_states', 'previous_cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ad = Listing::find($id);
        $user = Auth::user();
        $user_id = $user->id;

        if (! $user->isAdmin()) {
            if ($ad->user_id != $user_id) {
                return view('dashboard.error.error_404');
            }
        }

        $sub_category = Category::find($ad->sub_category_id);

        $rules = [
            'ad_title'          => 'required',
            'ad_description'    => 'required',
            'country'           => 'required',
            'seller_name'       => 'required',
            'seller_email'      => 'required',
            'seller_phone'      => 'required',
            'address'           => 'required',
        ];


        $this->validate($request, $rules);

        $title = $request->ad_title;
        //$slug = unique_slug($title);

        $is_negotialble = $request->negotiable ? $request->negotiable : '0';
        $video_url = $request->video_url ? $request->video_url : '';

        $data = [
            'title'             => $request->ad_title,
            'description'       => $request->ad_description,
            'price'             => $request->price,
            'is_negotiable'     => $is_negotialble,

            'seller_name'       => $request->seller_name,
            'seller_email'      => $request->seller_email,
            'seller_phone'      => $request->seller_phone,
            'country_id'        => $request->country,
            'state_id'          => $request->state,
            'city_id'           => $request->city,
            'address'           => $request->address,
            'video_url'         => $video_url,
            'latitude'          => $request->latitude,
            'longitude'         => $request->longitude,
        ];

        $updated_ad = $ad->update($data);

        /**
         * iF add created
         */
        if ($updated_ad) {
            //Upload new image
            $this->uploadAdsImage($request, $ad->id);
        }

        return redirect()->back()->with('success', trans('app.ad_updated'));
    }


    public function adStatusChange(Request $request)
    {
        $slug = $request->slug;
        $ad = Listing::whereSlug($slug)->first();
        if ($ad) {
            $value = $request->value;

            $ad->status = $value;
            $ad->save();

            if ($value == 1) {
                return ['success' => 1, 'msg' => trans('app.ad_approved_msg')];
            } elseif ($value == 2) {
                return ['success' => 1, 'msg' => trans('app.ad_blocked_msg')];
            } elseif ($value == 3) {
                return ['success' => 1, 'msg' => trans('app.ad_archived_msg')];
            }
        }
        return ['success' => 0, 'msg' => trans('app.error_msg')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $slug = $request->slug;
        $ad = Listing::whereSlug($slug)->first();
        if ($ad) {
            $media = Media::whereAdId($ad->id)->get();
            if ($media->count() > 0) {
                foreach ($media as $m) {
//                    $storage = Storage::disk($m->storage);
//                    if ($storage->has('uploads/images/' . $m->media_name)) {
//                        $storage->delete('uploads/images/' . $m->media_name);
//                    }
//                    if ($m->type == 'image') {
//                        if ($storage->has('uploads/images/thumbs/' . $m->media_name)) {
//                            $storage->delete('uploads/images/thumbs/' . $m->media_name);
//                        }
//                    }
                    $m->delete();
                }
            }
            $ad->delete();
            return ['success' => 1, 'msg' => trans('app.media_deleted_msg')];
        }
        return ['success' => 0, 'msg' => trans('app.error_msg')];
    }

    public function getSubCategoryByCategory(Request $request)
    {
        $category_id = $request->category_id;
        $brands = Sub_Category::whereCategoryId($category_id)->select('id', 'category_name', 'category_slug')->get();
        return $brands;
    }

    public function getBrandByCategory(Request $request)
    {
        $category_id = $request->category_id;
        $brands = Brand::whereCategoryId($category_id)->select('id', 'brand_name')->get();

        //Save into session about last category choice
        session(['last_category_choice' => $request->ad_type ]);
        return $brands;
    }

    public function getStateByCountry(Request $request)
    {
        $country_id = $request->country_id;
        $states = State::whereCountryId($country_id)->select('id', 'state_name')->get();
        return $states;
    }

    public function getCityByState(Request $request)
    {
        $state_id = $request->state_id;
        $cities = City::whereStateId($state_id)->select('id', 'city_name')->get();
        return $cities;
    }

    public function getParentCategoryInfo(Request $request)
    {
        $category_id = $request->category_id;
        $sub_category = Category::find($category_id);
        $category = Category::find($sub_category->category_id);
        return $category;
    }

    public function uploadAdsImage(Request $request, $ad_id = 0)
    {
        $user_id = 0;

        if (Auth::check()) {
            $user_id = Auth::user()->id;
        }

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
                        $created_img_db = Media::create(['user_id' => $user_id, 'ad_id' => $ad_id, 'media_name' => $image_name, 'type' => 'image', 'storage' => get_option('default_storage'), 'ref' => 'ad']);

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
    /**
     * @param Request $request
     * @return array
     */

    public function deleteMedia(Request $request)
    {
        abort(400);
        $media_id = $request->media_id;
        $media = Media::find($media_id);

        $storage = Storage::disk($media->storage);
        if ($storage->has('uploads/images/' . $media->media_name)) {
            $storage->delete('uploads/images/' . $media->media_name);
        }

        if ($media->type == 'image') {
            if ($storage->has('uploads/images/thumbs/' . $media->media_name)) {
                $storage->delete('uploads/images/thumbs/' . $media->media_name);
            }
        }

        $media->delete();
        return ['success' => 1, 'msg' => trans('app.media_deleted_msg')];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function featureMediaCreatingAds(Request $request)
    {
        $user_id = Auth::user()->id;
        $media_id = $request->media_id;

        Media::whereUserId($user_id)->whereAdId(0)->whereRef('ad')->update(['is_feature' => '0']);
        Media::whereId($media_id)->update(['is_feature' => '1']);

        return ['success' => 1, 'msg' => trans('app.media_featured_msg')];
    }

    /**
     * @return mixed
     */

    public function appendMediaImage()
    {
        $user_id = Auth::user()->id;
        $ads_images = Media::whereUserId($user_id)->whereAdId(0)->whereRef('ad')->get();

        return view('dashboard.append_media', compact('ads_images'));
    }

    /**
     * @param null $segment_one
     * @param null $segment_two
     * @param null $segment_three
     * @param null $segment_four
     * @param null $segment_five
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Search ads
     */

    public function search()
    {
        $pagination_output = null;
        $pagination_params = [];
        $title = null;

        $listings = Listing::active();

        //Search Keyword
        $search = request('search');

        //Search by keyword
        if ($search) {
            $listings = $listings->where('title', 'like', "%{$search}%")->orWhere('description', 'like', "%{$search}%");
        }

        $category = null;
        $brand = null;
        $type = null;

        if (request('category')) {
            $category = ProductCategory::find(request('category'));
            if ($category) {
                $listings = $listings->inCategory((int)request('category'));
                $title = $category->name;
            }
        }

        if (request('brand')) {
            $brand = Brand::find(request('brand'));
            if ($brand) {
                $listings = $listings->ofBrand(request('brand'));
            }
        }

        if (! $title) {
            $title = 'Search Results';
        }

        //Sort by filter
        if (request('sortBy')) {
            switch (request('sortBy')) {
                case 'price_high_to_low':
                    $listings = $listings->orderBy('price', 'desc');
                    break;
                case 'price_low_to_high':
                    $listings = $listings->orderBy('price', 'asc');
                    break;
                case 'latest':
                    $listings = $listings->orderBy('id', 'desc');
                    break;
            }
        } else {
            $listings = $listings->orderBy('id', 'desc');
        }

        $listings = $listings->paginate(20);

        $level1Cat = null;
        $level2Cat = null;
        $level2Cat = null;
        $level3Cat = null;
        $categoryLevel = 1;
        if ($category) {
            $level1Cat = $category;
        }
        if ($category && $category->parent) {
            $categoryLevel = 2;
            $level1Cat = $category->parent;
            $level2Cat = $category;

            if ($category->parent->parent) {
                $categoryLevel = 3;
                $level1Cat = $category->parent->parent;
                $level2Cat = $category->parent;
                $level3Cat = $category;
            }
        }

        $searchState = [
            'search' => $search,
            'category' => request('category'),
            'brand' => request('brand'),
            'type' => request('type'),
        ];

        return view('search', [
            'ads' => $listings,
            'title' => $title,
            'brand' => $brand,
            'pagination_output' => $pagination_output,
            'category' => $category,
            'categories' => $this->getDenormalizedProductCategories(),
            'categoryLevel' => $categoryLevel,
            'level1Cat' => $level1Cat,
            'level2Cat' => $level2Cat,
            'level3Cat' => $level3Cat,
            'searchState' => $searchState,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Redirect to search route
     */
    public function searchRedirect(Request $request)
    {
        $city = $cat = null;
        if ($request->city) {
            $city = 'city-' . $request->city;
        }
        if ($request->cat) {
            $cat = 'cat-' . $request->cat;
        }
        $search_url = route('search', [$city, $cat]);
        $search_url = $search_url . '?' . http_build_query(['q' => $request->q]);

        return redirect($search_url);
    }


    /**
     * @param $slug
     * @return mixed
     */
    public function singleAuction($id, $slug)
    {
        $listing = Listing::find($id);

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

    public function switchGridListView(Request $request)
    {
        session(['grid_list_view' => $request->grid_list_view]);
    }
}
