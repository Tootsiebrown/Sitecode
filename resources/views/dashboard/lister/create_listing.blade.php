@extends('layouts.dashboard')
@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('page-css')
    <link href="{{asset('assets/css/bootstrap-datetimepicker-standalone.css')}}" rel="stylesheet">
    @livewireStyles
@endsection

@section('dashboard-content')

    <div id="post-new-ad">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    @if (! Auth::check())
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
                                <input type="text" id="product_sku" class="form-control" value="{{ $product->id }}" readonly disabled>
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

                        <div class="form-group {{ $errors->has('price')? 'has-error':'' }}">
                            <label for="price" class="col-sm-4 control-label"> <span class="ad_text"> Price </span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="price" value="{{ round(old('price') ?? $product->price, 2) }}" name="price" placeholder="Listing Price">
                                {!! $errors->has('price')? '<p class="help-block">'.$errors->first('price').'</p>':'' !!}
                            </div>
                        </div>

                        <div class="listing-type-select" data-component="listing-type-select">
                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                <label for="select-listing-type" class="col-sm-4 control-label">Listing Type</label>
                                <div class="col-sm-8">
                                    <select name="type" id="select-listing-type" data-element="select" class="select2">
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
                                <label for="listing-quantity" class="col-sm-4 control-label">Quantity</label>
                                <div class="col-sm-8">
                                    <input name="quantity" id="listing-quantity" type="text" class="form-control">
                                    {!! $errors->has('quantity')? '<p class="help-block">'.$errors->first('quantity').'</p>':'' !!}
                                </div>
                            </div>

                            <div
                                class="form-group {{ $errors->has('bid_deadline')? 'has-error':'' }} listing-type-select__bid-deadline"
                                data-element="bidDeadline"
                            >
                                <label for="bid_deadline" class="col-sm-4 control-label"> @lang('app.bid_deadline')</label>
                                <div class="col-sm-8">
                                    <input
                                      type="text"
                                      class="form-control"
                                      id="bid_deadline"
                                      value="{{ old('bid_deadline') }}"
                                      name="bid_deadline"
                                      placeholder="@lang('app.bid_deadline')"
                                      data-component="datetime-picker"
                                    >
                                    {!! $errors->has('bid_deadline')? '<p class="help-block">'.$errors->first('bid_deadline').'</p>':'' !!}
                                </div>

                            </div>

                            <div data-component="sub-listing-to-ebay">
                                @include('dashboard.form-elements.form-group', [
                                    'type' => 'boolean',
                                    'name' => 'send_to_ebay',
                                    'prettyTitle' => 'Send To eBay',
                                    'checked' => old('send_to_ebay', false),
                                    'groupClass' => 'send-to-ebay-check',
                                ])

                                <div class="send-to-ebay-settings">
                                    @include('dashboard.form-elements.form-group', [
                                        'type' => 'datetime',
                                        'name' => 'send_to_ebay_at',
                                        'prettyTitle' => 'Send At',
                                        'value' => old('send_to_ebay_at', Illuminate\Support\Carbon::now()->addDays(3)),
                                    ])

                                    @include('dashboard.form-elements.form-group', [
                                        'type' => 'text',
                                        'name' => 'send_to_ebay_markup',
                                        'prettyTitle' => 'eBay Markup %',
                                        'value' => old('send_to_ebay_markup', 30)
                                    ])
                                    <div id="ebay-categories-container">
                                        @livewire('ebay-listing-fields', ['listing' => null])
                                    </div>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('offers_enabled')? 'has-error':'' }} listing-type-select__offers-enabled" data-element="offersEnabled">
                                <label for="offers_enabled" class="col-sm-4 control-label">
                                    Accepts Offers
                                </label>
                                <div class="col-sm-8">
                                    <input type="checkbox" id="offers_enabled" {{ old('offers_enabled', true) ? 'checked' : '' }} value="1" name="offers_enabled">
                                    {!! $errors->has('offers_enabled')? '<p class="help-block">'.$errors->first('offers_enabled').'</p>':'' !!}
                                </div>
                            </div>
                        </div>

                        @include('dashboard.form-elements.form-group', [
                            'type' => 'boolean',
                            'checked' => old('secret', false),
                            'prettyTitle' => 'Secret',
                            'note' => 'hidden from search and front page',
                            'name' => 'secret',
                        ])

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
                        </div>
                    </form>
                </div>

            </div> <!-- #row -->

        </div> <!-- /#container -->
    </div>
</div>
@endsection

@section('page-js')
    @livewireScripts
    <script>
        @if(session('success'))
        toastr.success('{{ session('success') }}', '<?php echo trans('app.success') ?>', toastr_options);
        @endif
    </script>

    @if(get_option('enable_recaptcha_post_ad') == 1)
        <script src='//www.google.com/recaptcha/api.js'></script>
    @endif

@endsection
