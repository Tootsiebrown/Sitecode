@extends('site.layouts.base', ['bodyClass' => 'gencon'])

@section('body')
    <div class="container">
    	{!! Breadcrumbs::draw() !!}
        <h1 class="page-title">{{ $page['title'] }}</h1>
    	@section('content')
    		<div class="editable-content">
    			{!! $page['content'] ?? '' !!}
    		</div>
    	@show
    </div>
@endsection
