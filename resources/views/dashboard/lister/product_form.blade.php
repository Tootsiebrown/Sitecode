@extends('layouts.app')
@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('page-css')
    <link href="{{asset('assets/plugins/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker3.css')}}" rel="stylesheet">
@endsection

@section('content')

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
                        <input type="hidden" name="product_id" {{ $product->id }}
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
                    @endif

                    <div class="form-group {{ $errors->has('name')? 'has-error':'' }}">
                        <label for="state_name" class="col-sm-4 control-label">Product Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" value="{{ old('name') ?? request('name') ?? $product->name ?? '' }}" name="name" placeholder="">
                            {!! $errors->has('name')? '<p class="help-block">'.$errors->first('name').'</p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('upc')? 'has-error':'' }}">
                        <label for="state_name" class="col-sm-4 control-label">UPC</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="upc" value="{{ old('upc') ?? request('upc') ?? $product->upc ?? '' }}" name="upc" placeholder="">
                            {!! $errors->has('upc')? '<p class="help-block">'.$errors->first('upc').'</p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('original_price')? 'has-error':'' }}">
                        <label for="state_name" class="col-sm-4 control-label">Original Price</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="original_price" value="{{ old('original_price') ?? $product['original_price'] ?? '' }}" name="original_price" placeholder="">
                            {!! $errors->has('original_price')? '<p class="help-block">'.$errors->first('original_price').'</p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('price')? 'has-error':'' }}">
                        <label for="state_name" class="col-sm-4 control-label">Listing Price</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="price" value="{{ old('price') ?? $product['price'] ?? '' }}" name="price" placeholder="">
                            {!! $errors->has('price')? '<p class="help-block">'.$errors->first('price').'</p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('new')? 'has-error':'' }}">
                        <label for="new" class="col-sm-4 control-label">Condition</label>
                        <div class="col-sm-8">
                            <label>
                                <input
                                  type="checkbox"
                                  name="new"
                                  value="1"
                                  @if (old('new') !== null) {{ old('new') == true ? 'checked="checked"':'' }}
                                  @elseif (request('new') !== null) {{ request('new') == true ? 'checked="checked"' : '' }}
                                  @elseif ($product->new) checked="checked"
                                  @endif > New
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
                                        <option value="new">New...</option>
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
                                  value="{{ old('new_brand') ?? request('new_brand') ?? $product['brand'] ?? '' }}"
                                  name="new_brand"
                                  placeholder=""
                                >
                                {!! $errors->has('new_brand')? '<p class="help-block">'.$errors->first('new_brand').'</p>':'' !!}
                            </div>
                        </div>
                    </div>

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

                    <div id="child-wrapper" style="display: none;" class="select-or-new" data-component="select-or-new">
                        <legend>Product Child Category</legend>

                        <div class="form-group" id="child-category" >
                            <label for="child_category_id" class="col-sm-4 control-label">Child Category</label>
                            <div class="col-sm-8">
                                <select
                                  class="form-control select2 select-or-new__select"
                                  name="child_category_id"
                                  id="child_category_id"
                                  data-selected="{{ !is_null($product->child_category) ? $product->child_category->id : '' }}"
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
                      data-component="select-or-new"
                      class="select-or-new"
                    >
                        <legend>Product Grandchild Category</legend>
                        <div class="form-group" id="grandchild_category_id">
                            <label for="grandchild_category_id" class="col-sm-4 control-label">Grandchild Category</label>
                            <div class="col-sm-8">
                                <select
                                  class="form-control select2 select-or-new__select"
                                  name="grandchild_category_id"
                                  id="grandchild_category_id"
                                  data-selected="{{ !is_null($product->grandChildCategory) ? $product->grandChildCategory->id : '' }}"
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
                    </div> <!-- .grandchild-wrapper -->

                    <legend>Product Images</legend>

                    <div class="form-group {{ $errors->has('images')? 'has-error':'' }}">
                        <div class="col-sm-12">
                            <div class="col-sm-8 col-sm-offset-4">
                                <div class="upload-images-input-wrap">
                                    <input type="file" name="images[]" class="form-control" />
                                    <input type="file" name="images[]" class="form-control" />
                                </div>

{{--                                    <div class="image-ad-more-wrap">--}}
{{--                                        <a href="javascript:;" class="image-add-more"><i class="fa fa-plus-circle"></i> @lang('app.add_more')</a>--}}
{{--                                    </div>--}}
                            </div>
                            {!! $errors->has('images')? '<p class="help-block">'.$errors->first('images').'</p>':'' !!}
                        </div>
                    </div>

                    @if ($product->images->isNotEmpty())
                        <legend>Product Images</legend>

                        <div class="form-group {{ $errors->has('existing_images')? 'has-error':'' }}">
                            <div class="col-sm-12">
                                <div class="col-sm-8 col-sm-offset-4">
                                    <div class="upload-images-input-wrap">
                                        @foreach($product->images as $image)
                                            <label>
                                                <input
                                                  type="checkbox"
                                                  name="existing_images[{{ $image->id }}]"
                                                  class="form-control"
                                                  @if (old('existing_images.' . $image->id) == true) checked="checked"


                                                  @elseif (request('existing_images.' . $image->id) == true) checked="checked"


                                                  @elseif (! request()->has('existing_images')) checked="checked"


                                                  @endif
                                                />
                                                {{ $image->media_name }}
                                            </label>
                                        @endforeach
                                    </div>

{{--                                        <div class="image-ad-more-wrap">--}}
{{--                                            <a href="javascript:;" class="image-add-more"><i class="fa fa-plus-circle"></i> @lang('app.add_more')</a>--}}
{{--                                        </div>--}}
                                </div>
                                {!! $errors->has('images')? '<p class="help-block">'.$errors->first('images').'</p>':'' !!}
                            </div>
                        </div>
                    @endif

                    <legend>Optional Attributes</legend>

                    <div class="form-group {{ $errors->has('gender')? 'has-error':'' }}">
                        <label for="state_name" class="col-sm-4 control-label">Gender</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="gender" value="{{ old('gender') ?? $product['gender'] ?? '' }}" name="gender" placeholder="">
                            {!! $errors->has('gender')? '<p class="help-block">'.$errors->first('gender').'</p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('model_number')? 'has-error':'' }}">
                        <label for="state_name" class="col-sm-4 control-label">Model Number</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="model_number" value="{{ old('model_number') ?? $product['model_number'] ?? '' }}" name="model_number" placeholder="">
                            {!! $errors->has('model_number')? '<p class="help-block">'.$errors->first('model_number').'</p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('color')? 'has-error':'' }}">
                        <label for="state_name" class="col-sm-4 control-label">Color</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="color" value="{{ old('color') ?? $product['color'] ?? '' }}" name="color" placeholder="">
                            {!! $errors->has('color')? '<p class="help-block">'.$errors->first('color').'</p>':'' !!}
                        </div>
                    </div>

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
