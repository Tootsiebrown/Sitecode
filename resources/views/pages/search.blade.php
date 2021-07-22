@extends('layouts.app')
@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')
    <div class="page-header search-page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if( ! empty($title)) <h2>{{ $title }} </h2> @endif
                    <div class="breadcrumbs">
                        <a href="{{route('home')}}" >Home</a>
                        {!! $listings->appends(request()->input())->links() !!}
{{--                        @if ($category)--}}
{{--                            @if ($category->parent)--}}
{{--                                @if ($category->parent->parent)--}}
{{--                                    <a href="{{route('search', ['category' => $category->parent->parent->id])}}">{{ $category->parent->parent->name }}</a>--}}
{{--                                @endif--}}
{{--                                <a href="{{route('search', ['category' => $category->parent->id])}}">{{ $category->parent->name }}</a>--}}
{{--                            @endif--}}
{{--                            <a href="{{route('search', ['category' => $category->id])}}">{{ $category->name }}</a>--}}
{{--                        @endif--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    <div class="itemViewFilterWrap">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}

{{--                <div class="col-md-12">--}}
{{--                    <div class="listingTopFilterBar">--}}
{{--                        <h4 class="pull-left">Total Found {{$ads->count()}} Auctions</h4>--}}

{{--                        <ul class="listingViewIcon pull-right">--}}
{{--                            <li class="dropdown shortByListingLi">--}}
{{--                                <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">@lang('app.sort_by') <span class="caret"></span></a>--}}
{{--                                <ul class="dropdown-menu">--}}
{{--                                    <li><a href="{{ request()->fullUrlWithQuery(['shortBy'=>'price_high_to_low']) }}">@lang('app.price_high_to_low')</a></li>--}}
{{--                                    <li><a href="{{ request()->fullUrlWithQuery(['shortBy'=>'price_low_to_high']) }}">@lang('app.price_low_to_high')</a></li>--}}
{{--                                    <li><a href="{{ request()->fullUrlWithQuery(['shortBy'=>'latest']) }}">@lang('app.latest')</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li><a href="javascript:;" class="itemListView"><i class="fa fa-bars"></i> </a></li>--}}
{{--                            <li><a href="javascript:;" class="itemImageListView"><i class="fa fa-th-list"></i> </a> </li>--}}
{{--                            <li><a href="javascript:;" class="itemGridView"><i class="fa fa-th-large"></i> </a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@php
    $OrderBy = Request::get('OrderBy');
    $params = request()->all();

@endphp

    @if($listings->count())
        <div id="regular-ads-container">
            <div class="container">
                <div class="row">
                    @include('pages.search.sidebar')
                    <div class="search-body col-xs-9">
                        <div class="alert alert-secondary" role="alert">
                            <div class="btn-group">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @switch($OrderBy)
                                        @case('price-asc')
                                            Price: Low to High
                                            @break
                                        @case('price-desc')
                                            Price: High to Low
                                            @break
                                        @case('created_at-desc')
                                            Update: Latest First
                                            @break
                                        @case('created_at-asc')
                                            Update: Oldest First
                                            @break
                                        @default
                                            Update: Latest First
                                    @endswitch
                                <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('search',array_merge($params,['OrderBy'=>'price-asc']))}}">Price: Low to High</a></li>
                                    <li><a href="{{route('search',array_merge($params,['OrderBy'=>'price-desc']))}}">Price: High to Low</a></li>
                                    <li><a href="{{route('search',array_merge($params,['OrderBy'=>'created_at-desc']))}}">Listed: New to Old</a></li>
                                    <li><a href="{{route('search',array_merge($params,['OrderBy'=>'created_at-asc']))}}">Listed: Old to New</a></li>
                                </ul>
                            </div>
                        </div>
                        @include('site.components.listings-list', ['listings' => $listings, 'container' => false])
                    </div>
                </div>


<div>
<h3 class="recommended">Recommended Items</h3>
</div>
<br><br><br><br>
<div class="flex-container">
<?php
$user = "Thing2";
$password = "Thing2";
$host = "host.mb:8889";
$database= "cndz_testing_db";
$connection= mysqli_connect ($host, $user, $password);
$db_select = mysqli_select_db($connection, $database);
$result= mysqli_query( $connection, ("SELECT listings.id,listing_items.listing_id,reserved_for_order_id,title,price,slug,ebay_order_id,media_name, listing_images.listing_id
from listings, listing_items, listing_images
where listings.id=listing_items.listing_id and reserved_for_order_id is NULL and ebay_order_id is NULL and listings.id=listing_images.listing_id
ORDER BY rand() limit 4") );


while ($row = mysqli_fetch_array($result)) {
    echo "<div class='recItems'>";
    printf( $row["title"]);
    echo " ";

    $image_name = ($row["media_name"]);
    $image_url = "assets/img/" . $image_name;
    echo "</br><img src='$image_url'></img></br>";

    $link_listing_sku = ($row["id"]);
    $link_listing_slug = ($row["slug"]);
    $link_address = "auction" . "/" . $link_listing_sku . "/" . $link_listing_slug;

    

    echo "<a href='$link_address'> <button>Check out this deal!</button></a>";
    echo "</br></div>";
}

?>
</div>

    @else
        <div class="container">
            <div class="row">
                @include('pages.search.sidebar')
                <div class="col-md-9 search-content">
                    <div class="no-content-wrap">
                        <h2> <i class="fa fa-info-circle"></i> @lang('app.there_is_no_ads')</h2>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! $listings->appends(request()->input())->links() !!}
            </div>
        </div>
    </div>

@endsection
