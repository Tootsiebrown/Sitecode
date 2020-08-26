@extends('layouts.app')
@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('page-css')
    <link href="{{asset('assets/plugins/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker3.css')}}" rel="stylesheet">
@endsection

@section('content')
    <script type="text/javascript">
        var categoryHierarchy = {!! json_encode($categoryHierarchy) !!};
    </script>
    <div class="container">

        <div id="wrapper">

            @include('dashboard.sidebar_menu')

            <div id="page-wrapper">

                @if( ! \Auth::check())
                    <div class="alert alert-info no-login-info">
                        <p> <i class="fa fa-info-circle"></i> @lang('app.no_login_info')</p>
                    </div>
                @endif

                @include('dashboard.flash_msg')

                <h2>{{ $action == 'new' ? 'New' : 'Edit' }} Product</h2>
                <form action="{{ route('lister.saveProduct') }}" id="listingPostForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="action" value="{{ $action }}">
                    @if ($action == 'edit')
                        <input type="hidden" name="product_id" {{ $product->id }}>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($product->id)
                        <input name="product_id" value="{{ $product->id }}" type="hidden">

                        <div class="form-group">
                            <label for="sku" class="col-sm-4 control-label">Product Sku</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" value="{{ $product->id }}" name="sku" placeholder="" readonly disabled>
                            </div>
                        </div>
                    @endif

                    <div class="form-group {{ $errors->has('name')? 'has-error':'' }}">
                        <label for="name" class="col-sm-4 control-label">Product Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" value="{{ old('name') ?? request('name') ?? $product->name ?? '' }}" name="name" placeholder="">
                            {!! $errors->has('name')? '<p class="help-block">'.$errors->first('name').'</p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('upc')? 'has-error':'' }}">
                        <label for="upc" class="col-sm-4 control-label">UPC</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="upc" value="{{ old('upc') ?? request('upc') ?? $product->upc ?? '' }}" name="upc" placeholder="">
                            {!! $errors->has('upc')? '<p class="help-block">'.$errors->first('upc').'</p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('original_price')? 'has-error':'' }}">
                        <label for="original_price" class="col-sm-4 control-label">Original Price</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="original_price" value="{{ old('original_price') ?? number_format($product->original_price ?? 0, 2, '.', '') }}" name="original_price" placeholder="">
                            {!! $errors->has('original_price')? '<p class="help-block">'.$errors->first('original_price').'</p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('price')? 'has-error':'' }}">
                        <label for="price" class="col-sm-4 control-label">Listing Price</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="price" value="{{ old('price') ?? number_format($product->price ?? 0, 2, '.', '') }}" name="price" placeholder="">
                            {!! $errors->has('price')? '<p class="help-block">'.$errors->first('price').'</p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('condition')? 'has-error':'' }}">
                        <label for="condition" class="col-sm-4 control-label">Condition</label>
                        <div class="col-sm-8">
                            <label>
                                <select name="condition" class="select2">
                                    @foreach ($product::getConditions() as $condition)
                                        <option value="{{ $condition }}" @if ($condition === $product->condition) selected @endif>
                                            {{ $condition }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>

                            {!! $errors->has('new')? '<p class="help-block">'.$errors->first('new').'</p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('description')? 'has-error':'' }}">
                        <label class="col-sm-4 control-label">Description</label>
                        <div class="col-sm-8">
                            <textarea name="description" class="form-control" id="description_editor" rows="8">{!! old('description')?? $product['description'] ?? '' !!}</textarea>
                            {!! $errors->has('description')? '<p class="help-block">'.$errors->first('description').'</p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('features')? 'has-error':'' }}">
                        <label class="col-sm-4 control-label">Features</label>
                        <div class="col-sm-8">
                            <textarea name="features" class="form-control" id="features_editor" rows="8">{!! old('features') ?? $product['features'] ?? '' !!}</textarea>
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
                                              @elseif ($brand->id == $product->brand_id) selected="selected"
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
                            @if (!$categories->isEmpty())
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
                                          data-child-data-url="{{ route("getProductCategoryChildren") }}"
                                          data-url-parameter="category_id"
                                          data-child-name="Child Category"
                                        >
                                            <option value="">Select Category...</option>
                                            <option value="new">New Category...</option>
                                            @foreach($categories as $category)
                                                <option
                                                  value="{{ $category->id }}"
                                                  @if ($category->id == old('category_id')) selected="selected"
                                                  @elseif ($category->id == request('category_id')) selected="selected"
                                                  @elseif ($product->categories->pluck('id')->contains($category->id)) selected="selected"
                                                  @endif
                                                >{{ $category->name }}</option>
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
                                      data-selected="{{ old('child_category_id') ?? (!is_null($product->child_category) ? $product->child_category->id : '') }}"
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
                                    <input type="text" class="form-control" id="new_child_category" value="{{ old('new_child_category') ?? $product->child->id ?? '' }}" name="new_child_category" placeholder="" />
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
                                          data-selected="{{ old('grandchild_category_id') ?? (!is_null($product->grandchild_category) ? $product->grandchild_category->id : '') }}"
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
                                        <input type="text" class="form-control" id="new_grandchild_category" value="{{ old('new_grandchild_category') ?? $product['grandchild'] ?? '' }}" name="new_grandchild_category" placeholder="" />
                                        {!! $errors->has('new_grandchild_category')? '<p class="help-block">'.$errors->first('new_grandchild_category').'</p>':'' !!}
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .grandchild-wrapper -->
                    </div>
                    <legend>Product Images</legend>

                    <div class="images-wrapper" data-component="lister-product-image-wrapper">
                        @foreach($product->images as $image)
                            @if ($errors->any() && !in_array($image->id, old('existing_images', [])))
                                {{-- if we already submitted, but this was deleted, don't bring it back.--}}
                                @continue
                            @endif

                            <div class="lister-product-image clearfix" data-component="lister-product-image">
                                <input
                                    type="hidden"
                                    name="existing_images[]"
                                    value="{{ $image->id }}"
                                />
                                <label class="col-sm-4 control-label"></label>
                                <div class="col-sm-8 lister-product-image__display-container">
                                    <div class="lister-product-image__image-wrapper"><img src="{{ $image->url }}"></div>
                                    <a href="#" data-element="delete"><i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        @endforeach
                        @if (is_array(old('new_images')) && !empty(old('new_images')))
                            @foreach (old('new_images') as $newImage)
                                    <div class="lister-product-image clearfix" data-component="lister-product-image" data-saved="false">
                                        <input
                                            type="hidden"
                                            name="new_images[]"
                                            value="{{ $newImage }}"
                                        />
                                        <label class="col-sm-4 control-label"></label>
                                        <div class="col-sm-8 lister-product-image__display-container">
                                            <div class="lister-product-image__image-wrapper"><img src="/{{ App\ProductImage::getUrlPath() . $newImage }}"></div>
                                            <a href="#" data-element="delete"><i class="fa fa-trash"></i> Delete</a>
                                        </div>
                                    </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('new_image')? 'has-error':'' }}">
                        <div class="col-sm-12">

                            <label class="col-sm-4 control-label">New Image</label>
                            <div class="col-sm-8">
                                <div class="new-product-image" data-component="new-product-image">
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
                                <input type="text" class="form-control" id="{{ $optionalFieldName }}" value="{{ old($optionalFieldName) ?? $product[$optionalFieldName] ?? '' }}" name="{{ $optionalFieldName }}" placeholder="">
                                {!! $errors->has($optionalFieldName)? '<p class="help-block">'.$errors->first($optionalFieldName).'</p>':'' !!}
                            </div>
                        </div>
                    @endforeach

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-primary">Save Product</button>
                        </div>
                    </div>
                </form>
            </div> <!-- .page-wrapper -->
        </div> <!-- #wrapper -->
    </div><!-- .container -->

@endsection

@section('page-js')

    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        //CKEDITOR.replace( 'description_editor' );
        CKEDITOR.replace( 'features_editor' );
    </script>
    <script src="{{asset('assets/plugins/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.js')}}"></script>
    <script type="text/javascript">
        $('#application_deadline, #bid_deadline').datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            startDate: new Date(),
            autoclose: true
        });
        $('#build_year').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true
        });
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
