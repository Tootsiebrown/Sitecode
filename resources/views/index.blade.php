@extends('layouts.app', ['bodyClass' => 'home'])
@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')
    @if($ads->count())
        <div id="regular-ads-container ads-slider-container">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <div class="front-ads-head">
                            <h2>@lang('app.new_regular_ads')</h2>
                            <h3>Don't miss out on the best catch of the day!</h3>
                        </div>
                    </div>

                    @include('site.components.listings-list', ['listings' => $ads])

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
