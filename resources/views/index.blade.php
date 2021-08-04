<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>


@extends('layouts.app', ['bodyClass' => 'home'])
@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('page-css')
    <link rel="stylesheet" href="/assets/home/slick.css">
@endsection

@section('content')
    <div class="slider" data-component="home-slider">
        @foreach ($slides as $slide)
            <div class="slide" style="background-image: url({{ $slide['background_image']->url }});">
                <div class="container">
                    <div class="wavy"></div>
                    <div class="content">
                        <div class="content__copy-container">
                            <div class="content__copy">
                                <h2>{{ $slide['title'] }}</h2>
                                <p>{{ $slide['caption'] }}</p>
                                <a href="{{ $slide['url'] }}" class="btn btn-default">{{ $slide['cta'] }} @svg(arrow)</a>
                            </div>
                        </div>
                        <div class="content__image" style="background-image: url({{ $slide['image']->url }})">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="banner-message container-fluid">
  <div class="marquee">
    <h3><i class="fas fa-exclamation-triangle"></i> SITE WIDE DISCOUNTS - 50% OFF ALL ITEMS EXCLUDING MYSTERY BOXS, HIGH END ELECTRONICS, AND WHOLESALE CATEGORIES! <i class="fas fa-exclamation-triangle"></i></h3>
  </div>

  <div class="marquee">
  <h3 id="secondmessage"> <i class="fas fa-money-bill-wave" id="money"></i> Use code Save50% and start saving today! <i class="fas fa-money-bill-wave"id="money"></i> </h3>
  </div>
</div>
    <div class="home-featured">

        <div class="container">
            <h2>
                Featured Items
            </h2>
                @include('site.components.listings-list', ['listings' => $featuredListings])
            </div>
        </div>

    @if($listings->count())
        <div id="regular-ads-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="front-ads-head">
                            <h2>New Items</h2>
                        </div>
                    </div>
                    @include('site.components.listings-list', ['listings' => $listings])
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="no-ads-wrap">
                        <h2><i class="fa fa-frown-o"></i> @lang('app.no_regular_ads_country') </h2>

                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('page-js')
    @slick
@endsection
<!--       _
       .__(.)< (MEOW)
        \___)   
 ~~~~~~~~~~~~~~~~~~-->
</body>
</html>
