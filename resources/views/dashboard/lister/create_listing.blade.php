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
                <div id="post-new-ad">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">

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

                                    <div class="form-group">
                                        <label for="product_sku" class="col-sm-4 control-label">Product SKU</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="{{ $product->id }}" readonly disabled>
                                            <p class="text-info">(Listing will have a different unique SKU, too.</p>
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('title')? 'has-error':'' }}">
                                        <label for="title" class="col-sm-4 control-label"> <span class="ad_text"> Listing </span> @lang('app.title')</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="title" value="{{ old('title') ?? $product->name }}" name="title" placeholder="Listing Title">
                                            {!! $errors->has('title')? '<p class="help-block">'.$errors->first('title').'</p>':'' !!}
                                            <p class="text-info"> @lang('app.great_title_info')</p>
                                        </div>
                                    </div>

                                    <div class="listing-type-select" data-component="listing-type-select">
                                        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                            <label for="type" class="col-sm-4 control-label">Listing Type</label>
                                            <div class="col-sm-8">
                                                <select name="type" data-element="select" class="select2">
                                                    <option value="">Select Listing Type...</option>
                                                    <option value="auction" @if (old('type') === 'auction') selected @endif>Auction</option>
                                                    <option value="set-price" @if (old('type') === 'set-price') selected @endif>Set Price</option>
                                                </select>
                                                {!! $errors->has('title')? '<p class="help-block">'.$errors->first('title').'</p>':'' !!}
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

                                        <div
                                          class="form-group {{ $errors->has('bid_deadline')? 'has-error':'' }} listing-type-select__bid-deadline"
                                          data-element="bidDeadline"
                                        >
                                            <label for="bid_deadline" class="col-sm-4 control-label"> @lang('app.bid_deadline')</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="bid_deadline" value="{{ old('bid_deadline') }}" name="bid_deadline" placeholder="@lang('app.bid_deadline')">
                                                {!! $errors->has('bid_deadline')? '<p class="help-block">'.$errors->first('bid_deadline').'</p>':'' !!}
                                            </div>
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
            </div>
        </div>
    </div>

@endsection

@section('page-js')
    <script src="{{asset('assets/plugins/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.js')}}"></script>
    <script type="text/javascript">
        $('#bid_deadline').datepicker({
                format: "yyyy-mm-dd",
                todayHighlight: true,
                startDate: new Date(),
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
