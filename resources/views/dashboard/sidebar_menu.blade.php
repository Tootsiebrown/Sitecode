
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav">
        <ul class="nav" id="side-menu">


            <li> <a href="{{ route('profile') }}"><i class="fa fa-user"></i> @lang('app.profile')</a>  </li>

            @if($lUser->hasPrivilege('Lister'))
                <li>
                    <a href="{{ route('lister.index') }}">
                        <i class="fa fa-barcode"></i>
                        Product Catalog
                    </a>
                </li>
            @endif

            @if($lUser->hasPrivilege('Listings'))
                <li>
                    <a href="{{ route('dashboard.listings.index') }}"><i class="fa fa-bullhorn"></i> Listings</a>
                    {{--                    <a href="#"><i class="fa fa-bullhorn"></i> @lang('app.ads')<span class="fa arrow"></span> <span class="label label-default pull-right"><i class="fa fa-user"></i> </span>  </a>--}}
                    {{--                    <ul class="nav nav-second-level">--}}
                    {{--                        <li>  <a href="{{ route('approved_ads') }}">@lang('app.approved_ads')</a> </li>--}}
                    {{--                        <li>  <a href="{{ route('admin_pending_ads') }}">@lang('app.pending_for_approval')</a> </li>--}}
                    {{--                    </ul>--}}
                </li>
                <li>
                    <a href="{{ route('dashboard.auctions.index') }}"><i class="fa fa-hourglass"></i> Shop Auctions</a>
                </li>
            @endif

            @if($lUser->hasPrivilege('Bins'))
                <li>
                    <a href="{{ route('dashboard.bins.index') }}"><i class="fa fa-archive"></i> Bins</a>
                </li>
            @endif

            @if ($lUser->hasPrivilege('Tax Table'))
                <li>
                    <a href="{{ route('dashboard.tax.zones.index') }}"><i class="fa fa-bank"></i> Tax Table</a>
                </li>
                <li>
                    <a href="{{ route('dashboard.tax.report.index') }}"><i class="fa fa-area-chart"></i> Tax Report</a>
                </li>

                </li>
            @endif

            @if ($lUser->hasPrivilege('Categories'))
                <li>
                    <a href="{{ route('dashboard.categories.index') }}"><i class="fa fa-folder"></i> Categories</a>
                </li>
            @endif

            @if ($lUser->hasPrivilege('Brands'))
                <li>
                    <a href="{{ route('dashboard.brands.index') }}"><i class="fa fa-registered"></i> Brands</a>
                </li>
            @endif

            @if ($lUser->hasPrivilege('Promo Codes'))
                <li>
                    <a href="{{ route('dashboard.promoCodes.index') }}"><i class="fa fa-percent"></i> Promo Codes</a>
                </li>
            @endif

            <li>
                <a href="{{ route('dashboard.auction-activity') }}">
                    <i class="fa fa-hourglass"></i>
                    Auction Activity
                </a>
            </li>

            <li>
                <a href="{{ route('dashboard.my-offers.index') }}">
                    <i class="fa fa-question-circle"></i>
                    My offers
                </a>
            </li>

            <li>
                <a href="{{ route('dashboard.orders.index') }}">
                    <i class="fa fa-shopping-basket"></i>
                    My Orders
                </a>
            </li>

            <li>
                <a href="{{ route('favorite_ads') }}">
                    <i class="fa fa-star"></i>
                    @lang('app.favourite_ads')
                </a>
            </li>

            <li> <a href="{{ route('dashboard.paymentMethods.index') }}"><i class="fa fa-money"></i> Payment Methods</a></li>

            <li>
                <a href="{{ route('dashboard.shippingAddresses.index') }}">
                    <i class="fa fa-address-card"></i>
                    Shipping Addresses
                </a>
            </li>

            @if($lUser->hasPrivilege('Manager'))
{{--                <li> <a href="{{ route('parent_categories') }}"><i class="fa fa-list"></i> @lang('app.categories') <span class="label label-default pull-right"><i class="fa fa-user"></i> </span></a>  </li>--}}
{{--                <li> <a href="{{ route('admin_comments') }}"><i class="fa fa-comment-o"></i> @lang('app.comments') <span class="label label-default pull-right"><i class="fa fa-user"></i> </span></a>  </li>--}}
                <li>
                    <a href="{{ route('users') }}"><i class="fa fa-users"></i> @lang('app.users')</a>
                </li>

                <li>
                    <a href="{{ route('dashboard.emails.index') }}"><i class="fa fa-send"></i> Email Previews</a>
                </li>
            @endif

            @if($lUser->hasPrivilege('Orders'))
                <li>
                    <a href="{{ route('dashboard.shop.orders.index') }}"><i class="fa fa-credit-card-alt"></i> Shop Orders</a>
                </li>


                <li>
                    <a href="{{ route('dashboard.shop.orders.report') }}">
                        <i class="fa fa-list-alt"></i>
                        Order Processing Report
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard.shop.orders.salesByCategory') }}">
                        <i class="fa fa-list-alt"></i>
                        Sales By Category
                    </a>
                </li>
            @endif

            @if ($lUser->hasPrivilege('Carousel'))
                <li>
                    <a href="{{ route('dashboard.carousel.index') }}"><i class="fa fa-file-image-o"></i> Carousel</a>
                </li>
            @endif

            @if ($lUser->hasPrivilege('Offers'))
                <li>
                    <a href="{{ route('dashboard.offers.index') }}">
                        <i class="fa fa-reply-all"></i>
                        Shop Offers
                    </a>
                </li>
            @endif
{{--                <li>--}}
{{--                    <a href="#"><i class="fa fa-desktop fa-fw"></i> @lang('app.appearance')<span class="fa arrow"></span> <span class="label label-default pull-right"><i class="fa fa-user"></i> </span> </a>--}}
{{--                    <ul class="nav nav-second-level">--}}
{{--                        <li> <a href="{{ route('social_url_settings') }}">@lang('app.social_url')</a> </li>--}}
{{--                    </ul>--}}
{{--                    <!-- /.nav-second-level -->--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="#"><i class="fa fa-map-marker"></i> @lang('app.locations')<span class="fa arrow"></span> <span class="label label-default pull-right"><i class="fa fa-user"></i> </span> </a>--}}
{{--                    <ul class="nav nav-second-level">--}}
{{--                        <li> <a href="{{ route('country_list') }}">@lang('app.countries')</a> </li>--}}
{{--                        <li> <a href="{{ route('state_list') }}">@lang('app.states')</a> </li>--}}
{{--                        <li> <a href="{{ route('city_list') }}">@lang('app.cities')</a> </li>--}}
{{--                    </ul>--}}
{{--                    <!-- /.nav-second-level -->--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="#"><i class="fa fa-wrench fa-fw"></i> @lang('app.settings')<span class="fa arrow"></span> <span class="label label-default pull-right"><i class="fa fa-user"></i> </span> </a>--}}
{{--                    <ul class="nav nav-second-level">--}}
{{--                        <li> <a href="{{ route('general_settings') }}">@lang('app.general_settings')</a> </li>--}}
{{--                        <li> <a href="{{ route('ad_settings') }}">@lang('app.ad_settings_and_pricing')</a> </li>--}}
{{--                        <li> <a href="{{ route('payment_settings') }}">@lang('app.payment_settings')</a> </li>--}}
{{--                        <li> <a href="{{ route('language_settings') }}">@lang('app.language_settings')</a> </li>--}}
{{--                        <li> <a href="{{ route('file_storage_settings') }}">@lang('app.file_storage_settings')</a> </li>--}}
{{--                        <li> <a href="{{ route('social_settings') }}">@lang('app.social_settings')</a> </li>--}}
{{--                        <li> <a href="{{ route('re_captcha_settings') }}">@lang('app.re_captcha_settings')</a> </li>--}}
{{--                    </ul>--}}
{{--                    <!-- /.nav-second-level -->--}}
{{--                </li>--}}
{{--                <li> <a href="{{ route('administrators') }}"><i class="fa fa-users"></i> @lang('app.administrators') <span class="label label-default pull-right"><i class="fa fa-user"></i> </span> </a>  </li>--}}

            @if ($lUser->hasPrivilege('Ebay Authenticator'))
                <li>
                    <a href="{{ route('dashboard.ebayAuth.status') }}"><i class="fa fa-chain"></i> Ebay Link</a>
                </li>
            @endif

            @if ($lUser->hasPrivilege('Ebay Orders'))
                <li>
                    <a href="{{ route('dashboard.ebay.orders') }}"><i class="fa fa-cubes"></i> Ebay Orders</a>
                </li>
            @endif

            <li> <a href="{{ route('change_password') }}"><i class="fa fa-lock"></i> @lang('app.change_password')</a>  </li>
            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"
                >
                    <i class="fa fa-sign-out"></i>
                    @lang('app.logout')
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
