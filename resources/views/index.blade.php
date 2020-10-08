@extends('layouts.app', ['bodyClass' => 'home'])
@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('page-css')
    <link rel="stylesheet" href="/assets/home/slick.css">
@endsection

@section('content')
    <div class="slider" data-component="home-slider">
        @foreach ($slides as $slide)
            <div class="slide" style="background-image: url({{ $slide['background_image'] }});">
                <div class="container">
                    <div class="wavy"></div>
                    <div class="content">
                        <div class="content__copy-container">
                            <div class="content__copy">
                                <h2>{{ $slide['title'] }}</h2>
                                <p>{{ $slide['caption'] }}</p>
                                <a href="{{ $slide['link'] }}" class="btn btn-default">{{ $slide['cta'] }} @svg(arrow)</a>
                            </div>
                        </div>
                        <div class="content__image" style="background-image: url({{ $slide['image'] }})">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="home-featured">
        <div class="container">
            <h2>Featured Items</h2>
            <p>Don't miss out on the best catch of the day!</p>
                @include('site.components.listings-list', ['listings' => $featuredListings])
            </div>
        </div>
    </div>
    @if($listings->count())
        <div id="regular-ads-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="front-ads-head">
                            <h2>@lang('app.new_regular_ads')</h2>
                            <h3>Don't miss out on the best <i>new</i> catch of the day!</h3>
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
