@extends('layouts.dashboard')

@section('page-css')
    <link href="{{asset('assets/css/bootstrap-datetimepicker-standalone.css')}}" rel="stylesheet">
    @livewireStyles
@endsection

@section('dashboard-content')
    <script type="text/javascript">
        var categoryHierarchy = {!! json_encode($categoryHierarchy) !!};
    </script>
    <h2>Edit Listing</h2>
    <form action="{{ route('dashboard.listings.saveEdit', ['id' => $listing->id]) }}" id="" class="form-horizontal" method="post" enctype="multipart/form-data">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="sku" class="col-sm-4 control-label">Listing Sku</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="name" value="{{ $listing->id }}" name="listing_sku" placeholder="" readonly disabled>
            </div>
        </div>

        <div class="form-group">
            <label for="sku" class="col-sm-4 control-label">Product Sku</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="name" value="{{ $listing->product_id }}" name="product_sku" placeholder="" readonly disabled>
            </div>
        </div>

        <div class="form-group">
            <label for="type" class="col-sm-4 control-label">Listing Type</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="type" value="{{ $listing->type }}" name="type" placeholder="" readonly disabled>
            </div>
        </div>

        @if ($listing->type === 'auction')
            <div class="form-group">
                <label for="expired_at" class="col-sm-4 control-label">Auction Ends At</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="expired_at" value="{{ $listing->expired_at->toDateTimeString() }}" name="expired_at" placeholder="" readonly disabled>
                </div>
            </div>
        @endif

        <div class="form-group">
            <label for="expired_at" class="col-sm-4 control-label">Bins</label>
            <div class="col-sm-8">
                <a href="{{ route('dashboard.bins.showListingBins', ['id' => $listing->id]) }}">Edit Bins</a>
                @if ($listing->is_set_price)
                    <br>Edit quantity by adding more items and bins
                @endif
            </div>
        </div>

        <div class="form-group {{ $errors->has('title')? 'has-error':'' }}">
            <label for="title" class="col-sm-4 control-label">Listing Title</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="title" value="{{ old('title') ?? request('title') ?? $listing->title ?? '' }}" name="title" placeholder="">
                {!! $errors->has('title')? '<p class="help-block">'.$errors->first('title').'</p>':'' !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('upc')? 'has-error':'' }}">
            <label for="upc" class="col-sm-4 control-label">UPC</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="upc" value="{{ old('upc') ?? request('upc') ?? $listing->upc ?? '' }}" name="upc" placeholder="">
                {!! $errors->has('upc')? '<p class="help-block">'.$errors->first('upc').'</p>':'' !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('original_price')? 'has-error':'' }}">
            <label for="original_price" class="col-sm-4 control-label">Original Price</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="original_price" value="{{ old('original_price') ?? number_format($listing->original_price ?? 0, 2, '.', '') }}" name="original_price" placeholder="">
                {!! $errors->has('original_price')? '<p class="help-block">'.$errors->first('original_price').'</p>':'' !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('price')? 'has-error':'' }}">
            <label for="price" class="col-sm-4 control-label">Listing Price</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="price" value="{{ old('price') ?? number_format($listing->price ?? 0, 2, '.', '') }}" name="price" placeholder="">
                {!! $errors->has('price')? '<p class="help-block">'.$errors->first('price').'</p>':'' !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('condition')? 'has-error':'' }}">
            <label for="condition" class="col-sm-4 control-label">Condition</label>
            <div class="col-sm-8">
                <select name="condition" class="select2">
                    @foreach ($listing::getConditions() as $condition)
                        <option value="{{ $condition }}" @if ($condition === $listing->condition) selected @endif>
                            {{ $condition }}
                        </option>
                    @endforeach
                </select>
                {!! $errors->has('new')? '<p class="help-block">'.$errors->first('new').'</p>':'' !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('featured')? 'has-error':'' }}">
            <label for="featured" class="col-sm-4 control-label">
                Featured
            </label>
            <div class="col-sm-8">
                <input type="checkbox" id="featured" {{ old('featured', $listing->featured) ? 'checked' : '' }} value="1" name="featured">
                {!! $errors->has('featured')? '<p class="help-block">'.$errors->first('featured').'</p>':'' !!}
            </div>
        </div>

        @if ($listing->type == 'set-price')
            <div class="form-group {{ $errors->has('offers_enabled')? 'has-error':'' }}">
                <label for="offers_enabled" class="col-sm-4 control-label">
                    Accepts Offers
                </label>
                <div class="col-sm-8">
                    <input type="checkbox" id="offers_enabled" {{ old('offers_enabled', $listing->offers_enabled) ? 'checked' : '' }} value="1" name="offers_enabled">
                    {!! $errors->has('offers_enabled')? '<p class="help-block">'.$errors->first('offers_enabled').'</p>':'' !!}
                </div>
            </div>

            @if ($listing->sent_to_ebay_at)
                @include('dashboard.form-elements.form-group', [
                    'type' => 'note',
                    'prettyTitle' => 'Send To Ebay',
                    'name' => 'na',
                    'note' => 'Listing has already been sent to eBay.',
                ])
            @else
                <div class="send-to-ebay" data-component="listing-to-ebay">

                    @include('dashboard.form-elements.form-group', [
                        'type' => 'boolean',
                        'name' => 'send_to_ebay',
                        'prettyTitle' => 'Send To eBay',
                        'checked' => old('send_to_ebay', $listing->send_to_ebay),
                        'groupClass' => 'send-to-ebay',
                    ])

                    <div class="send-to-ebay-settings">
                        @include('dashboard.form-elements.form-group', [
                            'type' => 'datetime',
                            'name' => 'send_to_ebay_at',
                            'prettyTitle' => 'Send To eBay At',
                            'value' => old('send_to_ebay_at', $listing->send_to_ebay_at),
                            'options' => [
                                'time' => true,
                            ]
                        ])

                        @include('dashboard.form-elements.form-group', [
                            'type' => 'text',
                            'name' => 'send_to_ebay_markup',
                            'prettyTitle' => 'eBay Markup %',
                            'value' => old('send_to_ebay_markup', $listing->send_to_ebay_markup ?? 30),
                        ])

                        <div id="ebay-categories-container">
                            @livewire('ebay-listing-fields', ['listing' => $listing])
                        </div>
                    </div>
                </div>
            @endif

        @endif

        @include('dashboard.form-elements.form-group', [
            'type' => 'boolean',
            'checked' => $listing->secret,
            'prettyTitle' => 'Secret',
            'note' => 'hidden from search and front page',
            'name' => 'secret',
        ])

        <div class="form-group {{ $errors->has('shipping_weight_oz')? 'has-error':'' }}">
            <label for="shipping_weight_oz" class="col-sm-4 control-label">Shipping Weight (oz)</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="shipping_weight_oz" value="{{ old('shipping_weight_oz') ?? $listing->shipping_weight_oz }}" name="shipping_weight_oz" placeholder="">
                {!! $errors->has('shipping_weight_oz')? '<p class="help-block">'.$errors->first('shipping_weight_oz').'</p>':'' !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('description')? 'has-error':'' }}">
            <label class="col-sm-4 control-label">Description</label>
            <div class="col-sm-8">
                <textarea name="description" class="form-control" id="description_editor" rows="8">{!! old('description')?? $listing['description'] ?? '' !!}</textarea>
                {!! $errors->has('description')? '<p class="help-block">'.$errors->first('description').'</p>':'' !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('features')? 'has-error':'' }}">
            <label class="col-sm-4 control-label">Features</label>
            <div class="col-sm-8">
                <textarea name="features" class="form-control" id="features_editor" rows="8">{!! old('features') ?? $listing['features'] ?? '' !!}</textarea>
                {!! $errors->has('features')? '<p class="help-block">'.$errors->first('features').'</p>':'' !!}
            </div>
        </div>

        <legend>Product Brand</legend>

        <div class="select-or-new" data-component="select-or-new">
            @if (!$brands->isEmpty())
                <div class="form-group">
                    <label for="brand_id" class="col-sm-4 control-label">Brand</label>
                    <div class="col-sm-8">
                        <select
                          data-element="select"
                          class="form-control select2 select-or-new__select"
                          name="brand_id"
                          id="brand_id"
                        >
                            <option value="">Select Brand...</option>
                            <option value="new" @if (!empty($newBrand)) selected="selected" @endif>New...</option>
                            @foreach($brands as $brand)
                                <option
                                  value="{{ $brand->id }}"
                                  @if ($brand->id == old('brand_id')) selected="selected"
                                  @elseif ($brand->id == request('brand_id')) selected="selected"
                                  @elseif ($brand->id == $listing->brand_id) selected="selected"
                                  @endif
                                >{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif

            <div
              data-element="new"
              class="form-group {{ $errors->has('new_brand')? 'has-error':'' }} select-or-new__new"
            >
                <label for="brand" class="col-sm-4 control-label">New Brand:</label>
                <div class="col-sm-8">
                    <input
                      type="text"
                      class="form-control"
                      id="new_brand"
                      value="{{ old('new_brand') ?? request('new_brand') ?? $newBrand ?? '' }}"
                      name="new_brand"
                      placeholder=""
                    >
                    {!! $errors->has('new_brand')? '<p class="help-block">'.$errors->first('new_brand').'</p>':'' !!}
                </div>
            </div>
        </div>

        <div data-component="product-categories-hierarchy">
            <legend>Product Category</legend>

            <div class="select-or-new" data-component="select-or-new">
                @if (!$categoryHierarchy->isEmpty())
                    <div class="form-group">
                        <label for="category_id" class="col-sm-4 control-label">Category</label>
                        <div class="col-sm-8">
                            <select
                              class="form-control select2 select-or-new__select"
                              name="category_id"
                              id="category_id"
                              data-element="select"
                              data-product-categories-hierarchy-element="topSelect"
                              data-component="select-with-child"
                              data-child-wrapper="#child-wrapper"
                              data-child-name="Child Category"
                            >
                                <option value="">Select Category...</option>
                                <option value="new">New Category...</option>
                                @foreach($categoryHierarchy as $category)
                                    <option
                                      value="{{ $category['id'] }}"
                                      @if ($category['id'] == old('category_id')) selected="selected"
                                      @elseif ($category['id'] == request('category_id')) selected="selected"
                                      @elseif ($listing->categories->pluck('id')->contains($category['id'])) selected="selected"
                                      @endif
                                    >{{ $category['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                <div
                  class="form-group select-or-new__new {{ $errors->has('new_category')? 'has-error':'' }}"
                  data-element="new"
                >
                    <label for="category" class="col-sm-4 control-label">New Category</label>
                    <div class="col-sm-8">
                        <input
                          type="text"
                          class="form-control"
                          id="new_category"
                          value="{{ old('new_category') ?? request('new_category') ?? '' }}"
                          name="new_category"
                          placeholder=""
                        >
                        {!! $errors->has('category')? '<p class="help-block">'.$errors->first('new_category').'</p>':'' !!}
                    </div>
                </div>
            </div>
            <div
              id="child-wrapper"
              class="select-or-new"
              data-component="select-or-new"
              data-product-categories-hierarchy-element="child-select"
              data-my-child-hierarchy-component="[data-component='grand-child-select-component']"
            >
                <legend>Product Child Category</legend>

                <div class="form-group" id="child-category" >
                    <label for="child_category_id" class="col-sm-4 control-label">Child Category</label>
                    <div class="col-sm-8">
                        <select
                          class="form-control select2 select-or-new__select"
                          name="child_category_id"
                          id="child_category_id"
                          data-selected="{{ old('child_category_id') ?? (!is_null($listing->child_category) ? $listing->child_category->id : '') }}"
                          data-element="select"
                          data-component="select-with-child"
                          data-child-wrapper="#grandchild-wrapper"
                          data-child-data-url="{{ route("getProductCategoryChildren") }}"
                          data-url-parameter="category_id"
                          data-child-name="Grandchild Category"
                        >
                            <option value="">Select Child Category..</option>
                            <option value="new">New Child Category...</option>
                            @foreach($children as $child)
                                <option value="{{ $child->id }}" @if ($child->id == old('child_category_id')) selected="selected" @endif>{{ $child->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div
                    class="form-group select-or-new__new {{ $errors->has('new_child_category')? 'has-error':'' }}"
                    data-element="new"
                >
                    <label for="new_child_category" class="col-sm-4 control-label">New Child Category</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="new_child_category" value="{{ old('new_child_category') ?? $listing->child->id ?? '' }}" name="new_child_category" placeholder="" />
                        {!! $errors->has('new_child_category')? '<p class="help-block">'.$errors->first('new_child_category').'</p>':'' !!}
                    </div>
                </div>
            </div> <!-- .child-wrapper -->

            <div
              id="grandchild-wrapper"
              data-component="grand-child-select-component"
            >
                <legend>Product Grandchild Category</legend>
                <div class="select-or-new" data-component="select-or-new">
                    <div class="form-group" id="grandchild_category_id"
                         data-component="select-or-new">
                        <label for="grandchild_category_id" class="col-sm-4 control-label">Grandchild Category</label>
                        <div class="col-sm-8">
                            <select
                              class="form-control select2 select-or-new__select"
                              name="grandchild_category_id"
                              id="grandchild_category_id"
                              data-selected="{{ old('grandchild_category_id') ?? (!is_null($listing->grandchild_category) ? $listing->grandchild_category->id : '') }}"
                              data-element="select"
                            >
                                <option value="">Select Grandchild Category...</option>
                                <option value="new">New Grandchild Category...</option>
                                @foreach($grandchildren as $grandchild)
                                    <option value="{{ $grandchild->id }}" @if ($grandchild->id == old('grandchild_category_id')) selected="selected" @endif>{{ $grandchild->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div
                      class="form-group select-or-new__new{{ $errors->has('new_grandchild_category')? 'has-error':'' }}"
                      data-element="new"
                    >
                        <label for="new_grandchild_category" class="col-sm-4 control-label">New Grandchild Category</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="new_grandchild_category" value="{{ old('new_grandchild_category') ?? $listing['grandchild'] ?? '' }}" name="new_grandchild_category" placeholder="" />
                            {!! $errors->has('new_grandchild_category')? '<p class="help-block">'.$errors->first('new_grandchild_category').'</p>':'' !!}
                        </div>
                    </div>
                </div>
            </div> <!-- .grandchild-wrapper -->
        </div>
        <legend>Product Images</legend>

        <div class="images-wrapper" data-component="multi-image-sort">
            @foreach($listing->images as $image)
                @if ($errors->any() && !in_array($image->id, old('existing_images', [])))
                    {{-- if we already submitted, but this was deleted, don't bring it back.--}}
                    @continue
                @endif
                @include('dashboard.shared.product-listing-image-repeater')
            @endforeach
            @if (is_array(old('new_images')) && !empty(old('new_images')))
                @foreach (old('new_images') as $key => $filename)
                    @include('dashboard.shared.product-listing-new-image-repeater', [
                        'imageId' => $key + 1,
                        'urlPath' => \App\Models\Listing\Image::getUrlPath(),
                        'filename' => $filename,
                    ])
                @endforeach
            @endif
        </div>
        <input type="hidden" name="imageSortOrder" value="{{ old('imageSortOrder') }}" data-element="sortOrderInput">

        <div class="form-group {{ $errors->has('new_image')? 'has-error':'' }}">
            <div class="col-sm-12">

                <label class="col-sm-4 control-label">New Image</label>
                <div class="col-sm-8">
                    <div class="new-product-image" data-component="new-product-image" data-type="listing">
                        <input
                          type="file"
                          name="new_image"
                          data-element="input"
                          class="form-control new-product-image__input"
                          data-action="{{ route('lister.upload-image') }}"
                        />
                        <div class="new-product-image__spinner" data-element="spinner">
                            <img src="/assets/img/loading-spinner.gif" alt="loading">
                        </div>
                        <p class="new-product-image__message" data-element="message"></p>
                    </div>
                </div>
                {!! $errors->has('new_image ')? '<p class="help-block">'.$errors->first('images').'</p>':'' !!}
            </div>
        </div>

        <legend>Optional Attributes</legend>

        @foreach ($optionalFields as $optionalFieldName => $optionalFieldLabel)
            <div class="form-group {{ $errors->has($optionalFieldName)? 'has-error':'' }}">
                <label for="{{ $optionalFieldName }}" class="col-sm-4 control-label">{{ $optionalFieldLabel }}</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="{{ $optionalFieldName }}" value="{{ old($optionalFieldName) ?? $listing[$optionalFieldName] ?? '' }}" name="{{ $optionalFieldName }}" placeholder="">
                    {!! $errors->has($optionalFieldName)? '<p class="help-block">'.$errors->first($optionalFieldName).'</p>':'' !!}
                </div>
            </div>
        @endforeach

        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-primary">Save Listing</button>
            </div>
        </div>
    </form>

@endsection

@section('page-js')
    @livewireScripts

    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        //CKEDITOR.replace( 'description_editor' );
        CKEDITOR.replace( 'features_editor' );
    </script>

    <script>
        @if(session('success'))
        toastr.success('{{ session('success') }}', '<?php echo trans('app.success') ?>', toastr_options);
        @endif
    </script>

    @if(get_option('enable_recaptcha_post_ad') == 1)
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endif
@endsection
