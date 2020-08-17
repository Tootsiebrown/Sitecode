<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@section('title') {{ get_option('site_title') }} @show</title>


    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-theme.min.css') }}">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- Font awesome 4.4.0 -->
    <link rel="stylesheet" href="{{ asset('assets/font-awesome-4.4.0/css/font-awesome.min.css') }}">
    <!-- load page specific css -->

    <!-- main select2.css -->
    <link href="{{ asset('assets/select2-4.0.3/css/select2.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">

    <!-- Conditional page load script -->
    @if(request()->segment(1) === 'dashboard')
        <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/metisMenu/dist/metisMenu.min.css') }}">
    @endif

<!-- main style.css -->
    <link rel="stylesheet" href="{{ asset("assets/css/style.css") }}">

    @if(is_rtl())
        <link rel="stylesheet" href="{{ asset("assets/css/rtl.css") }}">
    @endif

    @yield('page-css')

    <script src="{{ asset('assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
    <script type="text/javascript">
        window.jsonData = {!! frontendLocalisedJson() !!};
    </script>

</head>
<body class="@if(is_rtl()) rtl @endif">
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="/assets/img/catchndealz.svg" title="{{get_option('site_name')}}" alt="{{get_option('site_name')}}" />
                </a>

                <!-- Search -->
                <div class="navbar-search-wrap" class="more mobile-search">
                    <form
                      action="{{route('search_redirect')}}"
                      class="form-inline"
                      method="get"
                      enctype="multipart/form-data"
                    >
                        @csrf
                        <div class="input-group focusable" data-component="focusable-input-group">
                            <input
                              type="text"
                              class="form-control searchKeyword"
                              name="q"
                              placeholder="@lang('app.what_are_u_looking_short')"
                              data-element="input"
                            >
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">@php include(public_path('assets/img/magnifying-glass.svg')) @endphp</button>
                            </span>
                        </div>

                    </form>
                </div>

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>


            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;<li><a href="{{route('home')}}">@lang('app.home')</a> </li>
                    &nbsp;<li><a href="{{route('create_ad')}}">@lang('app.post_an_ad')</a> </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right nav-sarchbar">
                    <!-- Authentication Links -->


                    <li>
                        <div class="navbar-search-wrap" class="more">
                            <form action="{{route('search_redirect')}}" class="form-inline" method="get" enctype="multipart/form-data"> @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" id="searchKeyword" name="q" placeholder="@lang('app.what_are_u_looking')">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">Go!</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </li>

                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">@lang('app.login')</a></li>
                    @else
                        <li>
                            <a href="{{ route('dashboard') }}">
                                {{ auth()->user()->name }} <span class="headerAvatar"> <img src="{{auth()->user()->get_gravatar()}}" /> </span>
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <ul class="footer-menu">
                        <li> <a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('app.home')</a></li>
                    </ul>

                    <div class="footer-heading">
                        <h3>{{get_option('site_name')}}</h3>
                    </div>

                    <div class="footer-social-links">
                        @php
                            $facebook_url = get_option('facebook_url');
                            $twitter_url = get_option('twitter_url');
                            $linked_in_url = get_option('linked_in_url');
                            $dribble_url = get_option('dribble_url');
                            $google_plus_url = get_option('google_plus_url');
                            $youtube_url = get_option('youtube_url');
                        @endphp
                        <ul>
                            @if($facebook_url)
                                <li><a href="{{$facebook_url}}"><i class="fa fa-facebook"></i> </a> </li>
                            @endif
                            @if($twitter_url)
                                <li><a href="{{$twitter_url}}"><i class="fa fa-twitter"></i> </a> </li>
                            @endif
                            @if($google_plus_url)
                                <li><a href="{{$google_plus_url}}"><i class="fa fa-google-plus"></i> </a> </li>
                            @endif
                            @if($youtube_url)
                                <li><a href="{{$youtube_url}}"><i class="fa fa-youtube"></i> </a> </li>
                            @endif
                            @if($linked_in_url)
                                <li><a href="{{$linked_in_url}}"><i class="fa fa-linkedin"></i> </a> </li>
                            @endif
                            @if($dribble_url)
                                <li><a href="{{$dribble_url}}"><i class="fa fa-dribbble"></i> </a> </li>
                            @endif
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>


<script src="{{ asset('assets/js/vendor/jquery-1.11.2.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/select2-4.0.3/js/select2.min.js') }}"></script>

<!-- Conditional page load script -->
@if(request()->segment(1) === 'dashboard')
    <script src="{{ asset('assets/plugins/metisMenu/dist/metisMenu.min.js') }}"></script>
    <script>
        $(function() {
            $('#side-menu').metisMenu();
        });
    </script>
@endif
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>
<script>
    var toastr_options = {closeButton : true};
</script>

@yield('page-js')
</body>
</html>
