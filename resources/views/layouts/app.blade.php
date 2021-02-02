<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('google-analytics-datalayer')

    @if(App::environment('production'))
        <!-- Google Tag Manager -->
            <script>
                (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({
                    'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-MQ87S2C');
            </script>
        <!-- End Google Tag Manager -->
    @endif

    <title>@section('title') {{ get_option('site_title') }} @show</title>


    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-theme.min.css') }}">

    <!-- Font awesome 4.4.7 -->
    <link rel="stylesheet" href="{{ asset('assets/font-awesome-4.7.0/css/font-awesome.min.css') }}">


    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- main select2.css -->
    <link href="{{ asset('assets/select2-4.0.3/css/select2.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">



    <!-- main style.css -->
    <link rel="stylesheet" href="{{ asset("assets/css/style.css") }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Conditional page load script -->
    @if(request()->segment(1) === 'dashboard')
        <link rel="stylesheet" href="{{ mix('assets/css/admin.css') }}">
    @endif

    @if(is_rtl())
        <link rel="stylesheet" href="{{ asset("assets/css/rtl.css") }}">
    @endif

    <!-- load page specific css -->
    @yield('page-css')

    <script type="text/javascript">
        window.jsonData = {!! frontendLocalisedJson() !!};
    </script>

    @yield('social-meta')


</head>
<body class="@if(is_rtl()) rtl @endif @if(isset($bodyClass)) {{ $bodyClass }} @endif">

@if(App::environment('production'))
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MQ87S2C"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
@endif

<div id="app">
    @include('global.nav')

    @yield('content')

    @include('global.footer')

</div>


<script src="{{ asset('assets/js/vendor/jquery-1.11.2.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/select2-4.0.3/js/select2.min.js') }}"></script>

@yield('page-js')

<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>
<script>
    var toastr_options = {closeButton : true};
</script>
@stack('scripts')


<script src="{{ asset('assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>

@if(App::environment('production'))
    <!-- Start of HubSpot Embed Code -->
    <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/8559894.js"></script>
    <!-- End of HubSpot Embed Code -->
@endif


</body>
</html>
