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

                        <div class="form-group {{ $errors->has('name')? 'has-error':'' }}">
                            <label for="state_name" class="col-sm-4 control-label">Product Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" value="{{ old('name') ?? request('name') }}" name="name" placeholder="">
                                {!! $errors->has('name')? '<p class="help-block">'.$errors->first('name').'</p>':'' !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('upc')? 'has-error':'' }}">
                            <label for="state_name" class="col-sm-4 control-label">UPC</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="upc" value="{{ old('upc') ?? request('upc') }}" name="upc" placeholder="">
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

                        <div class="form-group {{ $errors->has('condition')? 'has-error':'' }}">
                            <label for="condition" class="col-sm-4 control-label">Condition</label>
                            <div class="col-sm-8">
                                <label>
                                    <input type="radio" name="condition" value="new"  @if(old('condition')) {{ old('condition') == 'new' ? 'checked="checked"':'' }} @else checked="checked" @endif > New
                                </label>
                                <br />

                                <label>
                                    <input type="radio" name="condition" value="used"  {{ old('condition') == 'used' ? 'checked="checked"':'' }} > Used
                                </label>

                                {!! $errors->has('condition')? '<p class="help-block">'.$errors->first('condition').'</p>':'' !!}
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

                        <legend>Product Images</legend>

                        <div class="form-group {{ $errors->has('images')? 'has-error':'' }}">
                            <div class="col-sm-12">
                                <div class="col-sm-8 col-sm-offset-4">
                                    <div class="upload-images-input-wrap">
                                        <input type="file" name="images[]" class="form-control" />
                                        <input type="file" name="images[]" class="form-control" />
                                    </div>

                                    <div class="image-ad-more-wrap">
                                        <a href="javascript:;" class="image-add-more"><i class="fa fa-plus-circle"></i> @lang('app.add_more')</a>
                                    </div>
                                </div>
                                {!! $errors->has('images')? '<p class="help-block">'.$errors->first('images').'</p>':'' !!}
                            </div>
                        </div>

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
            //Load Category Json Data To Brand Select
            if(fromLoad === 'country_to_state'){
                var option = '';
                if (jsonData.length > 0) {
                    option += '<option value="0" selected> @lang('app.select_state') </option>';
                    for ( i in jsonData){
                        option += '<option value="'+jsonData[i].id+'"> '+jsonData[i].state_name +' </option>';
                    }
                    $('#state_select').html(option);
                    $('#state_select').select2();
                }else {
                    $('#state_select').html('');
                    $('#state_select').select2();
                }
                $('#state_loader').hide('slow');

            }else if(fromLoad === 'state_to_city'){
                var option = '';
                if (jsonData.length > 0) {
                    option += '<option value="0" selected> @lang('app.select_city') </option>';
                    for ( i in jsonData){
                        option += '<option value="'+jsonData[i].id+'"> '+jsonData[i].city_name +' </option>';
                    }
                    $('#city_select').html(option);
                    $('#city_select').select2();
                }else {
                    $('#city_select').html('');
                    $('#city_select').select2();
                }
                $('#city_loader').hide('slow');
            }
        }

        $(document).ready(function(){

            $('[name="country"]').change(function(){
                var country_id = $(this).val();
                $('#state_loader').show();
                $.ajax({
                    type : 'POST',
                    url : '{{ route('get_state_by_country') }}',
                    data : { country_id : country_id,  _token : '{{ csrf_token() }}' },
                    success : function (data) {
                        generate_option_from_json(data, 'country_to_state');
                    }
                });
            });

            $('[name="state"]').change(function(){
                var state_id = $(this).val();
                $('#city_loader').show();
                $.ajax({
                    type : 'POST',
                    url : '{{ route('get_city_by_state') }}',
                    data : { state_id : state_id,  _token : '{{ csrf_token() }}' },
                    success : function (data) {
                        generate_option_from_json(data, 'state_to_city');
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
