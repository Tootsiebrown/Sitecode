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
                        {!! $listings->links() !!}
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

    @if($listings->count())
        <div id="regular-ads-container">
            <div class="container">
                <div class="row">
                    @include('pages.search.sidebar')
                    <div class="search-body col-xs-9">
                        @include('site.components.listings-list', ['listings' => $listings, 'container' => false])
                    </div>
                </div>
            </div>
        </div>

    @else
        <div class="container">
            <div class="row">
                @include('pages.search.sidebar')
                <div class="col-md-9">
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
                {!! $listings->links() !!}
            </div>
        </div>
    </div>

@endsection

@section('page-js')
    <script type="text/javascript">
        $(".select2LoadCity").select2({
            ajax: {
                url: "{{route('searchCityJson')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 3,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
        function formatRepo (repo) {
            if (repo.loading) return repo.city_name;

            var markup = "<div class='clearfix'>"+
                "<div class='select2-result-repository__title'> <i class='fa fa-map-marker'></i> " + repo.city_name + "</div></div>" +
                "</div></div>";

            return markup;
        }
        function formatRepoSelection (repo) {
            return repo.city_name || repo.text;
        }

        $('.itemListView').click(function (e) {
            e.preventDefault();
            switchItemView('itemListView');
        });

        $('.itemGridView').click(function (e) {
            e.preventDefault();
            switchItemView('itemGridView');
        });

        $('.itemImageListView').click(function (e) {
            e.preventDefault();
            switchItemView('itemImageListView');
        });

        function setInitialItemViewMode() {
            var isSavedViewMode = getCookie("itemViewMode");
            if (isSavedViewMode != "") {
                switchItemView(isSavedViewMode);
            }
        }
        setInitialItemViewMode();

        function switchItemView(mode){
            var item_loop = $('.item-loop');

            if (mode == 'itemListView'){
                item_loop.addClass('item-loop-list').removeClass('col-md-3 item-loop-list-thumb');
                item_loop.find('.ads-thumbnail').hide();
                setCookie('itemViewMode', 'itemListView', 30);
            }else if (mode == 'itemGridView'){
                item_loop.removeClass('item-loop-list item-loop-list-thumb').addClass('col-md-3');
                item_loop.find('.ads-thumbnail').show();
                setCookie('itemViewMode', 'itemGridView', 30);
            }else if(mode == 'itemImageListView'){
                item_loop.addClass('item-loop-list-thumb').removeClass('col-md-3 item-loop-list');
                item_loop.find('.ads-thumbnail').show();
                setCookie('itemViewMode', 'itemImageListView', 30);
            }
        }



    </script>
@endsection
