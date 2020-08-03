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

                    <h2>New Product</h2>
                    <form action="{{ route('lister.saveProduct') }}" id="listingPostForm" class="form-horizontal" method="post" enctype="multipart/form-data">
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

                        @if (!$brands->isEmpty())
                            <div class="form-group">
                                <label for="brand_id" class="col-sm-4 control-label">Existing Brand</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2" name="brand_id" id="brand_id">
                                        <option value="">Select existing Brand or enter new Brand below</option>
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

                        <div class="form-group {{ $errors->has('brand')? 'has-error':'' }}">
                            <label for="brand" class="col-sm-4 control-label">Brand</label>
                            <div class="col-sm-8">
                                <input
                                  type="text"
                                  class="form-control"
                                  id="brand"
                                  value="{{ old('brand') ?? $product['brand'] ?? '' }}"
                                  name="brand"
                                  placeholder=""
                                >
                                {!! $errors->has('brand')? '<p class="help-block">'.$errors->first('brand').'</p>':'' !!}
                            </div>
                        </div>

                        <legend>Product Category</legend>

                        @if (!$categories->isEmpty())
                            <div class="form-group">
                                <label for="existing_category" class="col-sm-4 control-label">Existing Category</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2" name="existing_category" id="existing_category">
                                        <option value="">Select existing Category or enter new Category below</option>
                                        @foreach($categories as $category)
                                            <option
                                              value="{{ $category->id }}"
                                              @if ($category->id == old('existing_category')) selected="selected"
                                              @elseif ($category->id == request('existing_category')) selected="selected"
                                              @elseif ($product->categories->pluck('id')->contains($category->id)) selected="selected"
                                              @endif
                                            >{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="form-group {{ $errors->has('category')? 'has-error':'' }}">
                            <label for="category" class="col-sm-4 control-label">Category</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="category" value="{{ old('category') ?? request('category') ?? '' }}" name="category" placeholder="">
                                {!! $errors->has('category')? '<p class="help-block">'.$errors->first('category').'</p>':'' !!}
                            </div>
                        </div>

                        <div id="child-wrapper" style="display: none;">
                            <legend>Product Child Category</legend>

                            <div class="form-group" id="existing-child">
                                <label for="existing_child" class="col-sm-4 control-label">Existing Child Category</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2" name="existing_child" id="existing_child" data-selected="{{ !is_null($product->child_category) ? $product->child_category->id : '' }}">
                                        <option value="">Select existing Child Category or enter new Child Category below</option>
                                        @foreach($children as $child)
                                            <option value="{{ $child->id }}" @if ($child->id == old('existing_child')) selected="selected" @endif>{{ $child->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('child')? 'has-error':'' }}">
                                <label for="child" class="col-sm-4 control-label">Child Category</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="child" value="{{ old('child') ?? $product->child->id ?? '' }}" name="child" placeholder="" />
                                    {!! $errors->has('child')? '<p class="help-block">'.$errors->first('child').'</p>':'' !!}
                                </div>
                            </div>
                        </div> <!-- .child-wrapper -->

                        <div id="grandchild-wrapper" style="display: none;">
                            <legend>Product Grandchild Category</legend>

                            <div class="form-group" id="existing-grandchild">
                                <label for="existing_grandchild" class="col-sm-4 control-label">Existing Grandchild Category</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2" name="existing_grandchild" id="existing_grandchild" data-selected="{{ !is_null($product->grandChildCategory) ? $product->grandChildCategory->id : '' }}">
                                        <option value="">Select existing Grandchild Category or enter new Grandchild Category below</option>
                                        @foreach($grandchildren as $grandchild)
                                            <option value="{{ $grandchild->id }}" @if ($grandchild->id == old('existing_grandchild')) selected="selected" @endif>{{ $grandchild->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('grandchild')? 'has-error':'' }}">
                                <label for="grandchild" class="col-sm-4 control-label">Grandchild Category</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="grandchild" value="{{ old('grandchild') ?? $product['grandchild'] ?? '' }}" name="grandchild" placeholder="" />
                                    {!! $errors->has('grandchild')? '<p class="help-block">'.$errors->first('grandchild').'</p>':'' !!}
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
        function generate_option_from_json(jsonData, fromLoad){
            //Load Category Json Data To Child Select
            if(fromLoad === 'category_children') {
                var option = '';
                if (jsonData.length > 0) {
                    option += '<option value="0" selected>Select existing Child Category or enter new Child Category below</option>';
                    for ( i in jsonData){
                        option += '<option value="'+jsonData[i].id+'"> '+jsonData[i].name +' </option>';
                    }
                    $('#existing_child').html(option);
                    $('#existing-child').show();
                    $('#child-wrapper').show();
                    $('#existing_child').select2();
                    if ($('#existing_child').get(0).hasAttribute('data-selected')) {
                        var stickyValue = $('#existing_child').attr('data-selected')
                        if (stickyValue) {
                            $('#existing_child').val(stickyValue);
                        }

                    }
                    $('#existing_child').trigger('change');
                } else {
                    $('#existing_child').html('');
                    $('#existing_child').select2();
                    $('#existing-child').hide();
                    $('#child-wrapper').hide();
                }
                // $('#state_loader').hide('slow');

            } else if(fromLoad === 'child_grandchildren') {
                var option = '';
                if (jsonData.length > 0) {
                    option += '<option value="0" selected>Select existing Grandchild Category or enter new Grandchild Category below</option>';
                    for ( i in jsonData){
                        option += '<option value="'+jsonData[i].id+'"> '+jsonData[i].name +' </option>';
                    }
                    $('#existing_grandchild').html(option);
                    $('#existing-grandchild').show();
                    $('#grandchild-wrapper').show();
                    $('#existing_grandchild').select2();
                } else {
                    $('#existing_grandchild').html('');
                    $('#existing_grandchild').select2();
                    $('#existing-grandchild').hide();
                    $('#grandchild-wrapper').hide();
                }
                // $('#state_loader').hide('slow');

            }
        }

        $(document).ready(function(){

            $('#category').each(function() {
                var elem = $(this);

                // Save current value of element
                elem.data('oldVal', elem.val());

                // Look for changes in the value
                elem.bind("propertychange keyup keydown input paste", function(event){
                    // If value has changed...
                    if (elem.data('oldVal') != elem.val()) {
                    // Updated stored value
                        elem.data('oldVal', elem.val());

                        if (elem.val().length > 0) {
                            $('#existing-child').hide();
                            $('#child-wrapper').show();
                        } else {
                            $('#child-wrapper').hide();
                        }
                    }
                });
            });

            $('#child').each(function() {
                var elem = $(this);

                // Save current value of element
                elem.data('oldVal', elem.val());

                // Look for changes in the value
                elem.bind("propertychange keyup keydown input paste", function(event){
                    // If value has changed...
                    if (elem.data('oldVal') != elem.val()) {
                    // Updated stored value
                        elem.data('oldVal', elem.val());

                        if (elem.val().length > 0) {
                            $('#existing-grandchild').hide();
                            $('#grandchild-wrapper').show();
                        } else {
                            $('#grandchild-wrapper').hide();
                        }
                    }
                });
            });

            $('[name="existing_category"]').change(function(){
                var category_id = $(this).val();
                // $('#state_loader').show();
                $.ajax({
                    type : 'POST',
                    url : '{{ route("get_product_category_children") }}',
                    data : { category_id : category_id,  _token : '{{ csrf_token() }}' },
                    success : function (data) {
                        generate_option_from_json(data, 'category_children', );
                    }
                });
            });

            $('[name="existing_child"]').change(function(){
                var category_id = $(this).val();
                // $('#state_loader').show();
                $.ajax({
                    type : 'POST',
                    url : '{{ route("get_product_category_children") }}',
                    data : { category_id : category_id,  _token : '{{ csrf_token() }}' },
                    success : function (data) {
                        generate_option_from_json(data, 'child_grandchildren');
                    }
                });
            });

            $('body').on('click', '.imgDeleteBtn', function(){
                //Get confirm from user
                if ( ! confirm('{{ trans('app.are_you_sure') }}')){
                    return '';
                }

                var current_selector = $(this);
                var img_id = $(this).closest('.img-action-wrap').attr('id');
                $.ajax({
                    url : '{{ route('delete_media') }}',
                    type: "POST",
                    data: { media_id : img_id, _token : '{{ csrf_token() }}' },
                    success : function (data) {
                        if (data.success == 1){
                            current_selector.closest('.creating-ads-img-wrap').hide('slow');
                            toastr.success(data.msg, '@lang('app.success')', toastr_options);
                        }
                    }
                });
            });

            $('[name="existing_category"]').trigger('change');
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