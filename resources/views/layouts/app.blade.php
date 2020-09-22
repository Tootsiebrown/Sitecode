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
        <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/metisMenu/dist/metisMenu.min.css') }}">
    @endif

    @if(is_rtl())
        <link rel="stylesheet" href="{{ asset("assets/css/rtl.css") }}">
    @endif

    <!-- load page specific css -->
    @yield('page-css')

    <script src="{{ asset('assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
    <script type="text/javascript">
        window.jsonData = {!! frontendLocalisedJson() !!};
    </script>

</head>
<body class="@if(is_rtl()) rtl @endif @if(isset($bodyClass)) {{ $bodyClass }} @endif">
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

</body>
</html>
