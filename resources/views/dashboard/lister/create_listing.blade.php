@extends('layouts.app')
@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('page-css')
    <link href="{{asset('assets/plugins/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker3.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div id="post-new-ad">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    @if( ! \Auth::check())
                        <div class="alert alert-info no-login-info">
                            <p> <i class="fa fa-info-circle"></i> @lang('app.no_login_info')</p>
                        </div>
                    @endif

                    @include('dashboard.flash_msg')

                    <form action="{{ route('lister.saveListing') }}" id="listingPostForm" class="form-horizontal" method="post" enctype="multipart/form-data"> @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}" />

                        <legend> <span class="ad_text"> Listing </span> Info for {{ $product->name }} </legend>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group {{ $errors->has('ad_title')? 'has-error':'' }}">
                            <label for="ad_title" class="col-sm-4 control-label"> <span class="ad_text"> Listing </span> @lang('app.title')</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ad_title" value="{{ old('ad_title') ?? $product->title }}" name="ad_title" placeholder="Listing Title">
                                {!! $errors->has('ad_title')? '<p class="help-block">'.$errors->first('ad_title').'</p>':'' !!}
                                <p class="text-info"> @lang('app.great_title_info')</p>
                            </div>
                        </div>

                        <div class="listing-type-select" data-component="listing-type-select">
                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                <label for="type" class="col-sm-4 control-label">Listing Type</label>
                                <div class="col-sm-8">
                                    <select name="type" data-element="select" class="select2">
                                        <option value="">Select Listing Type...</option>
                                        <option value="auction">Auction</option>
                                        <option value="buy-it-now">Buy it Now</option>
                                    </select>
                                    {!! $errors->has('ad_title')? '<p class="help-block">'.$errors->first('ad_title').'</p>':'' !!}
                                </div>
                            </div>

                            <div
                              class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }} listing-type-select__quantity"
                              data-element="quantity"
                            >
                                <label for="quantity" class="col-sm-4 control-label">Quantity</label>
                                <div class="col-sm-8">
                                    <input name="quantity" type="text" class="form-control">
                                    {!! $errors->has('quantity')? '<p class="help-block">'.$errors->first('quantity').'</p>':'' !!}
                                </div>
                            </div>

                        </div>

                        <div class="form-group {{ $errors->has('bid_deadline')? 'has-error':'' }}">
                            <label for="bid_deadline" class="col-sm-4 control-label"> @lang('app.bid_deadline')</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="bid_deadline" value="{{ old('bid_deadline') }}" name="bid_deadline" placeholder="@lang('app.bid_deadline')">
                                {!! $errors->has('bid_deadline')? '<p class="help-block">'.$errors->first('bid_deadline').'</p>':'' !!}
                            </div>
                        </div>

                        @if(get_option('enable_recaptcha_post_ad') == 1)
                            <div class="form-group {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="g-recaptcha" data-sitekey="{{get_option('recaptcha_site_key')}}"></div>
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save New Listing</button>
                            </div>
                            <div class="col-sm-offset-4 col-sm-8">
                                <p>Note: listings are not yet feature complete. Please do not yet depend on this feature.</p>
                            </div>
                        </div>
                    </form>
                </div>

            </div> <!-- #row -->

        </div> <!-- /#container -->
    </div>

@endsection

@section('page-js')

    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        // CKEDITOR.replace( 'content_editor' );
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
            /**
             * Change ads price by urgent or premium
             */

            $(document).on('change', '.price_input_group', function(){
                var price = 0;
                var checkedValues = $('.price_input_group input:checked').map(function() {
                    return $(this).data('price');
                }).get();

                for( var i = 0; i < checkedValues.length; i++ ){
                    price += parseInt( checkedValues[i]); //don't forget to add the base
                }

                $('#payable_amount').text(price);
                $('#price_summery').show('slow');
            });

            $(document).on('click', '.image-add-more', function (e) {
                e.preventDefault();
                $('.upload-images-input-wrap').append('<input type="file" name="images[]" class="form-control" />');
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
