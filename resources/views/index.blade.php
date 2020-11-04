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
    <div class="home-featured">
        <div class="container">
            <div class="welcome-copy">
                <p>Find great Dealz on everything for Home/Garden, Electronics, Appliances, Clothes, Shoes and much more! New items are listed daily! Enjoy <b>FREE SHIPPING on purchases over $50</b> and easy <a href="/returns">returns</a>.</p>
                <table class="home-shipping">
                    <thead>
                        <tr>
                            <th>Spend</th>
                            <th>Shipping Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>$50</td>
                            <td>FREE!</td>
                        </tr>
                        <tr>
                            <td>$30</td>
                            <td>$8.99</td>
                        </tr>
                        <tr>
                            <td>$10</td>
                            <td>$5.99</td>
                        </tr>
                        <tr>
                            <td>Less than $10</td>
                            <td>$2.99</td>
                        </tr>
                    </tbody>
                </table>
                <p class="a-us-company">A USA Made Company</p>
            </div>

            <h2>Featured Items</h2>
            <p>Check out our featured Daily Dealz</p>
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
