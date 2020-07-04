<!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	@section('doctitle')
		<title>{{ !empty($page['tabTitle']) ? $page['tabTitle'].' | ' : ''}}{{ config('app.name') }}</title>
	@show

	@include('site.components.head')

	@yield('head')
</head>
<body class="{{ $bodyClass ?? ''}}">
	@include('site.components.page-header')

	<main class="page-main">
		@yield('body')
	</main>

	@include('site.components.page-footer')

	@section('footer-js')
		@include('site.components.footer-js')
	@show
</body>
</html>
