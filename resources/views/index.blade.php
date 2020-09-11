@extends('layouts.app', ['bodyClass' => 'home'])
@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <p>
        A featured section up here...
    </p>

    @if($ads->count())
        <div id="regular-ads-container ads-slider-container">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <div class="front-ads-head">
                            <h2>@lang('app.new_regular_ads')</h2>
                            <h3>Don't miss out on the best catch of the daty!</h3>
                        </div>
                    </div>

                    @foreach($ads as $ad)
                        <div class="col-md-3">

                            <div class="ad-box">
                                <div class="ads-thumbnail">
                                    <a href="{{ route('single_ad', [$ad->id, $ad->slug]) }}">
                                        @if ($ad->featured_image)
                                            <img itemprop="image"  src="{{ $ad->featured_image->url }}" class="img-responsive" alt="{{ $ad->title }}">
                                        @endif
                                    </a>
                                </div>
                                <div class="caption">
                                    <div class="ad-box-caption-title">
                                        <a class="ad-box-title" href="{{ route('single_ad', [$ad->id, $ad->slug]) }}" title="{{ $ad->title }}">
                                            {{ str_limit($ad->title, 40) }}
                                        </a>
                                    </div>

                                    <div class="ad-box-category">
                                        @if($ad->sub_category)
                                            <a class="price text-muted" href="{{ route('search', [ $ad->country->country_code,  'category' => 'cat-'.$ad->sub_category->id.'-'.$ad->sub_category->category_slug]) }}"> <i class="fa fa-folder-o"></i> {{ $ad->sub_category->category_name }} </a>
                                        @endif
                                        @if($ad->city)
                                            <a class="location text-muted" href="{{ route('search', [$ad->country->country_code, 'state' => 'state-'.$ad->state->id, 'city' => 'city-'.$ad->city->id]) }}"> <i class="fa fa-map-marker"></i> {{ $ad->city->city_name }} </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="ad-box-footer">
                                    <span class="ad-box-price">@lang('app.starting_price') {!! themeqx_price($ad->price) !!},</span>
                                    <span class="ad-box-price">@lang('app.current_bid') {!! themeqx_price($ad->current_bid()) !!}</span>

                                    @if($ad->price_plan == 'premium')
                                        <div class="ad-box-premium" data-toggle="tooltip" title="@lang('app.premium_ad')">
                                            {!! $ad->premium_icon() !!}
                                        </div>
                                    @endif
                                </div>


                                <div class="countdown" data-expire-date="{{$ad->expired_at}}" ></div>
                                <div class="place-bid-btn">
                                    <a href="{{ route('single_ad', [$ad->id, $ad->slug]) }}" class="btn btn-primary">@lang('app.place_bid')</a>
                                </div>

                            </div>
                        </div>
                    @endforeach
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
