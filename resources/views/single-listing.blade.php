@extends('layouts.app')
@section('title') @if( ! empty($title)) {{ strip_tags($title) }} | @endif @parent @endsection

@section('social-meta')
    <meta property="og:title" content="{{ safe_output($listing->title) }}">
    <meta property="og:description" content="{{ substr(trim(preg_replace('/\s\s+/', ' ',strip_tags($listing->description) )),0,160) }}">
    @if($listing->images->first())
        <meta property="og:image" content="{{ $listing->images->first()->url }}">
    @else
        <meta property="og:image" content="{{ asset('uploads/placeholder.png') }}">
    @endif
    <meta property="og:url" content="{{  route('single_ad', [$listing->id, $listing->slug]) }}">
    <meta name="twitter:card" content="summary_large_image">
    <!--  Non-Essential, But Recommended -->
    <meta name="og:site_name" content="{{ get_option('site_name') }}">
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/fotorama-4.6.4/fotorama.css') }}">
@endsection

@section('content')
    @php /* @var App\Models\Listing $listing */ @endphp
    <div class="page-header search-page-header">
         <div class="container">
             <div class="row">
                 <div class="col-md-12">
                     <div class="breadcrumbs">
                         <a href="{{ route('home') }}">Home</a>
                         @if($listing->category)
                             <a href="{{ $listing->category->url }}"> {{ $listing->category->name }}</a>
                         @endif

                         @if($listing->child_category)
                             <a href="{{ $listing->child_category->url }}"> {{ $listing->child_category->name }}</a>
                         @endif

                         @if($listing->grandchild_category)
                             <a href="{{ $listing->grandchild_category->url }}"> {{ $listing->grandchild_category->name }}</a>
                         @endif
                     </div>
                 </div>
             </div>
         </div>
    </div>
    <div class="single-auction-wrap">

        <div class="container">
            <div class="single-ad__header">
                <div class="single-ad__info">
                    <h3>{{ safe_output($listing->title) }}</h3>
                    @include('dashboard.flash_msg')

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($listing->is_auction && ! auth()->check())
                        <div class="alert alert-warning">
                            <i class="fa fa-exclamation-circle"></i> @lang('app.before_bidding_sign_in_info')
                        </div>
                    @endif

                    <div class="single-ad__condition">{{ $listing->condition }}</div>
                    @if ($listing->is_auction)
                        @if($listing->is_bidding_active)
                            <p class="single-ad__time-limit">
                                {{sprintf(trans('app.bid_deadline_info'), $listing->bid_deadline(), $listing->bid_deadline_left())}}
                            </p>
                        @else
                            <div class="alert alert-warning">
                                <h4>@lang('app.bid_closed')</h4>
                                <p>@lang('app.cant_bid_anymore')</p>
                            </div>
                        @endif


                        <p class="single-ad__current-bid-headline">
                            @if($listing->is_bidding_active)
                                @lang('app.highest_bid')
                            @else
                                The final price was
                            @endif
                        </p>

                        <p class="single-ad__current-bid-amount">
                            {!! themeqx_price($listing->current_bid()) !!}
                        </p>

                        @if (!$listing->is_bidding_active && $listing->is_bid_accepted())
                            @if(Auth::check() && $listing->winning_bid->user_id == Auth::user()->id)
                                <a
                                  href="{{ route('payForEndedAuction', ['id' => $listing->id]) }}"
                                  class="btn btn-default"
                                >
                                    Pay now!
                                </a>
                            @endif
                        @else
                            <p class="single-ad__minimum-new-bid-amount">
                                Enter a bid of ${{ $listing->current_bid() + 1 }} or higher
                            </p>

                            @if($listing->type == 'auction' && ! auth()->check())
                                <div class="alert alert-warning">
                                    <i class="fa fa-exclamation-circle"></i> @lang('app.before_bidding_sign_in_info')
                                </div>
                            @else
                                <form action="{{ route('post_bid', $listing->id) }}" class="form-inline place-bid" method="post" enctype="multipart/form-data" novalidate>
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">{!! currency_sign() !!}</div>
                                            <input type="number" class="form-control" id="bid_amount" name="bid_amount" placeholder="@lang('app.bid_amount')" min="{{$listing->current_bid() + 1}}" required="required">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" type="submit">@lang('app.place_bid')</button>
                                            </span>
                                        </div>
                                    </div>
                                </form>

                                <a href="#" data-component="watch-listing" data-id="{{ $listing->id }}" class="btn btn-default">
                                    @if( ! $listing->is_my_favorite())
                                        @lang('app.save_ad_as_favorite') <i class="fa fa-eye"></i>
                                    @else
                                        @lang('app.remove_from_favorite') <i class="fa fa-eye-slash"></i>
                                    @endif
                                </a>
                            @endif
                        @endif
                    @elseif ($listing->is_set_price)
                        <p class="single-ad__current-bid-amount">
                            {!! themeqx_price($listing->price) !!}
                        </p>
                        @if ($listing->availableItems->count() === 0)
                            <p>Sorry, we&rsquo;re out of inventory.</p>
                        @else
                            <form action="{{ route('shop.cart.add') }}" class="form-inline place-bid" method="post" enctype="multipart/form-data" novalidate>
                                @csrf
                                <input type="hidden" name="customizations[1]" value="{{ $listing->id }}">
                                <input type="hidden" name="product_id" value="1">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">Qty:</div>
                                        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="#" required="required" value="{{ old('quantity') ?? 1 }}">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="submit">Add to Cart @svg(cart)</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <p class="single-ad__available-inventory">
                                Available Inventory: {{ $listing->availableItems->count() }}
                            </p>
                        @endif

                        @if (Auth::check())
                            @if ($alreadyHasOffer)
                                <p>You already have an offer on this listing</p>
                                @if (Auth::user()->hasAcceptedOfferOn($listing))
                                    <a href="{{ route('payForAcceptedOffer', ['id' => Auth::user()->offers()->where('listing_id', $listing->id)->status('accepted')->first()->id]) }}">Pay for it now</a>
                                @endif
                            @elseif ($listing->availableItems()->count() > 0)
                                <p><b>OR</b></p>
{{--                                <div class="make-an-offer" data-component="make-an-offer">--}}
{{--                                    <button data-element="button">Make and Offer</button>--}}
{{--                                </div>--}}
                                <form action="{{ route('makeAnOffer') }}" method="POST" class="form-horizontal">
                                    @csrf
                                    <input type="hidden" name="listing_id" value="{{ $listing->id }}">

                                    <legend>Make an Offer</legend>
                                    <div class="row">
                                        <label class="col-sm-2" for="offer_quantity">Qty:</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ old('offer_quantity', 1) }}" name="offer_quantity" id="offer_quantity">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2">$/each:</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ old('offer_price', $listing->price) }}" name="offer_price" id="offer_price">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-2">&nbsp;</label>
                                        <div class="col-sm-10">
                                            <input type="submit" name="offer" value="Submit" class="btn btn-primary">
                                        </div>
                                    </div>



                                </form>
                            @endif
                        @elseif ($listing->availableItems()->count() > 0)
                            <p>Please <a href="{{ route('login') }}">Login</a> if you want to make an offer</p>
                        @endif
                    @endif
                </div>
                <div class="single-ad__images">
                    <div class="auction-img-video-wrap">
                        @if ( ! $listing->is_published())
                            <div class="alert alert-warning"> <i class="fa fa-warning"></i> @lang('app.ad_not_published_warning')</div>
                        @endif
                        @if( ! empty($listing->video_url))
                            <?php
                            $video_url = safe_output($listing->video_url);
                            if (strpos($video_url, 'youtube') > 0) {
                                preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $video_url, $matches);
                                if ( ! empty($matches[1])){
                                    echo '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$matches[1].'" frameborder="0" allowfullscreen></iframe></div>';
                                }

                            } elseif (strpos($video_url, 'vimeo') > 0) {
                                if (preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $video_url, $regs)) {
                                    if (!empty($regs[3])){
                                        echo '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://player.vimeo.com/video/'.$regs[3].'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
                                    }
                                }
                            }
                            ?>
                        @else
                            <div class="ads-gallery">
                                <div class="fotorama"  data-nav="thumbs" data-allowfullscreen="true" data-width="100%">
                                    @foreach($listing->images as $img)
                                        <img src="{{ $img->url }}" alt="{{ $listing->title }}">
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            <div class="single-ad__general-area">
                @if ($listing->hasOptionalFieldsForDisplay())
                    <div class="single-ad__details">
                        <h4>Specifications</h4>
                        <ul>
                            @foreach($listing::getOptionalFieldsForDisplay() as $fieldName => $fieldLabel)
                                @if (!empty($listing->$fieldName))
                                    <li><span class="single-ad__details-item">{{ $fieldLabel }}</span>: {{ $listing->$fieldName }}</li>
                                @endif
                            @endforeach
                            @if ($listing->brand)
                                <li><span class="single-ad__details-item">Brand</span>: {{ $listing->brand->name }}</
                            @endif
                        </ul>
                    </div>
                @endif

                <div class="single-ad__description">
                    <h4>@lang('app.description')</h4>
                    {!! nl2br(safe_output($listing->description)) !!}
                    {!! nl2br(safe_output($listing->features)) !!}
                </div>
            </div>

            <div class="single-ad__meta">
                <p>Product SKU: {{ $listing->product_id }}</p>
                <p>Listing SKU: {{ $listing->id }}</p>
            </div>

            <div>
                @if(get_option('enable_comments') == 1)
                    <hr />
                    @php $comments = \App\Comment::approved()->parent()->whereAdId($listing->id)->with('childs_approved')->orderBy('id', 'desc')->get();
                    $comments_count = \App\Comment::approved()->whereAdId($listing->id)->count();
                    @endphp
                    <div class="comments-container">
                        @if($comments_count < 1)
                            <h2>@lang('app.no_comment_found')</h2>
                        @elseif($comments_count == 1)
                            <h2>{{$comments_count}} @lang('app.comment_found')</h2>
                        @elseif($comments_count > 1)
                            <h2>{{$comments_count}} @lang('app.comments_found')</h2>
                        @endif

                        <div class="post-comments-form">

                            <form action="{{route('post_comments', $listing->id)}}" class="form-horizontal" method="post" enctype="multipart/form-data"> @csrf

                                @if( ! auth()->check())
                                    <div class="form-group {{ $errors->has('author_name')? 'has-error':'' }}">
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="author_name" value="@if(auth()->check() ) {{auth()->user()->name}}@else{{old('author_name')}}@endif" name="author_name" placeholder="@lang('app.author_name')">
                                            {!! $errors->has('author_name')? '<p class="help-block">'.$errors->first('author_name').'</p>':'' !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('author_email')? 'has-error':'' }}">
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="author_email" value="@if(auth()->check() ) {{auth()->user()->email}}@else{{old('author_email')}}@endif" name="author_email" placeholder="@lang('app.author_email')">
                                            {!! $errors->has('author_email')? '<p class="help-block">'.$errors->first('author_email').'</p>':'' !!}
                                            <p class="text-info">@lang('app.email_secured')</p>
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group {{ $errors->has('comment')? 'has-error':'' }}">
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="comment" rows="8" placeholder="@lang('app.write_your_comment')"></textarea>
                                        {!! $errors->has('comment')? '<p class="help-block">'.$errors->first('comment').'</p>':'' !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <input type="hidden" value="" class="comment_id" name="comment_id">
                                        <button type="submit" class="btn btn-success" name="post_comment"><i class="fa fa-pencil-square"></i> @lang('app.post_comment') </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        @if($comments->count())
                            <ul id="comments-list" class="comments-list">

                                @foreach($comments as $comment)
                                    <li id="comment-{{$comment->id}}">
                                        <div class="comment-main-level">
                                            <!-- Avatar -->
                                            <div class="comment-avatar">
                                                @if($comment->user_id)
                                                    <img src="{{$comment->author->get_gravatar()}}" alt="{{$comment->author_name}}">
                                                @else
                                                    <img src="{{avatar_by_email($comment->author_email)}}" alt="{{$comment->author_name}}">
                                                @endif
                                            </div>
                                            <!-- Contenedor del Comentario -->
                                            <div class="comment-box" data-comment-id="{{$comment->id}}">
                                                <div class="comment-head">
                                                    <h6 class="comment-name by-author">{{$comment->author_name}}</h6>
                                                    <span>{{$comment->created_at->diffForHumans()}}</span>
                                                    <i class="fa fa-reply"></i>
                                                </div>
                                                <div class="comment-content">
                                                    {!! safe_output(nl2br($comment->comment)) !!}
                                                </div>

                                                <div class="reply_form_box" style="display: none;"></div>
                                            </div>
                                        </div>

                                    @if($comment->childs_approved)
                                        @foreach($comment->childs_approved as $childComment)
                                            <!-- Respuestas de los comentarios -->
                                                <ul class="comments-list reply-list">
                                                    <li id="comment-{{$childComment->id}}">
                                                        <!-- Avatar -->
                                                        <div class="comment-avatar">
                                                            @if($childComment->user_id)
                                                                <img src="{{$childComment->author->get_gravatar()}}" alt="{{$childComment->author_name}}">
                                                            @else
                                                                <img src="{{avatar_by_email($childComment->author_email)}}" alt="{{$childComment->author_name}}">
                                                            @endif
                                                        </div>
                                                        <!-- Contenedor del Comentario -->
                                                        <div class="comment-box" data-comment-id="{{$comment->id}}">
                                                            <div class="comment-head">
                                                                <h6 class="comment-name by-author">{{$childComment->author_name}}</h6>
                                                                <span>{{$childComment->created_at->diffForHumans()}}</span>
                                                                <i class="fa fa-reply"></i>
                                                            </div>
                                                            <div class="comment-content">
                                                                {!! safe_output(nl2br($childComment->comment)) !!}
                                                            </div>
                                                            <div class="reply_form_box" style="display: none;"></div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            @endforeach
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else

                        @endif
                    </div>
                @endif
            </div>

            <div class="related-ads">
                @if($relatedListings->count() > 0 && get_option('enable_related_ads') == 1)
                    <div class="widget similar-ads">
                        <h3>@lang('app.similar_ads')</h3>

                        @foreach($relatedListings as $rad)
                            <div class="item-loop">

                                <div class="ad-box">
                                    <div class="ads-thumbnail">
                                        <a href="{{ route('single_ad', [$rad->id, $rad->slug]) }}">
                                            <img itemprop="image"  src="{{ media_url($rad->feature_img) }}" class="img-responsive" alt="{{ $rad->title }}">
                                            <span class="modern-img-indicator">
                                                @if(! empty($rad->video_url))
                                                    <i class="fa fa-file-video-o"></i>
                                                @else
                                                    <i class="fa fa-file-image-o"> {{ $rad->media_img->count() }}</i>
                                                @endif
                                            </span>
                                        </a>
                                    </div>
                                    <div class="caption">
                                        <div class="ad-box-caption-title">
                                            <a class="ad-box-title" href="{{ route('single_ad', [$rad->id, $rad->slug]) }}" title="{{ $rad->title }}">
                                                {{ str_limit($rad->title, 40) }}
                                            </a>
                                        </div>

                                        <div class="ad-box-category">
                                            @if($rad->sub_category)
                                                <a class="price text-muted" href="{{ route('search', [ $rad->country->country_code,  'category' => 'cat-'.$rad->sub_category->id.'-'.$rad->sub_category->category_slug]) }}"> <i class="fa fa-folder-o"></i> {{ $rad->sub_category->category_name }} </a>
                                            @endif
                                            @if($rad->city)
                                                <a class="location text-muted" href="{{ route('search', [$rad->country->country_code, 'state' => 'state-'.$rad->state->id, 'city' => 'city-'.$rad->city->id]) }}"> <i class="fa fa-map-marker"></i> {{ $rad->city->city_name }} </a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="ad-box-footer">
                                        <span class="ad-box-price">@lang('app.starting_price') {!! themeqx_price($rad->price) !!},</span>
                                        <span class="ad-box-price">@lang('app.current_bid') {!! themeqx_price($rad->current_bid()) !!}</span>

                                        @if($rad->price_plan == 'premium')
                                            <div class="ad-box-premium" data-toggle="tooltip" title="@lang('app.premium_ad')">
                                                {!! $rad->premium_icon() !!}
                                            </div>
                                        @endif
                                    </div>


                                    <div class="countdown" data-expire-date="{{$rad->expired_at}}" ></div>
                                    <div class="place-bid-btn">
                                        <a href="{{ route('single_ad', [$rad->id, $rad->slug]) }}" class="btn btn-primary">@lang('app.place_bid')</a>
                                    </div>

                                </div>

                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="replyByEmail" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>

                <form action="" id="replyByEmailForm" method="post" enctype="multipart/form-data"> @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="control-label">@lang('app.name'):</label>
                            <input type="text" class="form-control" id="name" name="name" data-validation="required">
                        </div>

                        <div class="form-group">
                            <label for="email" class="control-label">@lang('app.email'):</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>

                        <div class="form-group">
                            <label for="phone_number" class="control-label">@lang('app.phone_number'):</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number">
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="control-label">@lang('app.message'):</label>
                            <textarea class="form-control" id="message" name="message"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="ad_id" value="{{ $listing->id }}" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('app.close')</button>
                        <button type="submit" class="btn btn-primary" id="reply_by_email_btn">@lang('app.send_email')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('page-js')
{{--    @if(get_option('enable_fb_comments') == 1)--}}
{{--        <div id="fb-root"></div>--}}
{{--        <script>(function(d, s, id) {--}}
{{--                var js, fjs = d.getElementsByTagName(s)[0];--}}
{{--                if (d.getElementById(id)) return;--}}
{{--                js = d.createElement(s); js.id = id;--}}
{{--                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10";--}}
{{--                fjs.parentNode.insertBefore(js, fjs);--}}
{{--            }(document, 'script', 'facebook-jssdk'));--}}
{{--        </script>--}}
{{--    @endif--}}

    <script src="{{ asset('assets/plugins/fotorama-4.6.4/fotorama.js') }}"></script>
{{--    <script src="{{ asset('assets/plugins/SocialShare/SocialShare.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/plugins/form-validator/form-validator.min.js') }}"></script>--}}

{{--    <script>--}}
{{--        $('.share').ShareLink({--}}
{{--            title: '{{ $listing->title }}', // title for share message--}}
{{--            text: '{{ substr(trim(preg_replace('/\s\s+/', ' ',strip_tags($listing->description) )),0,160) }}', // text for share message--}}

{{--            @if($listing->images->first())--}}
{{--            image: '{{ $listing->images->first()->url }}', // optional image for share message (not for all networks)--}}
{{--            @else--}}
{{--            image: '{{ asset('uploads/placeholder.png') }}', // optional image for share message (not for all networks)--}}
{{--            @endif--}}
{{--            url: '{{  route('single_ad', [$listing->id, $listing->slug]) }}', // link on shared page--}}
{{--            class_prefix: 's_', // optional class prefix for share elements (buttons or links or everything), default: 's_'--}}
{{--            width: 640, // optional popup initial width--}}
{{--            height: 480 // optional popup initial height--}}
{{--        })--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        $.validate();--}}
{{--    </script>--}}

{{--    <script>--}}
{{--        $(function(){--}}
{{--            $('#onClickShowPhone').click(function(){--}}
{{--                $('#ShowPhoneWrap').html('<i class="fa fa-phone"></i> {{ $listing->seller_phone }}');--}}
{{--            });--}}

{{--            $('#replyByEmailForm').submit(function(e){--}}
{{--                e.preventDefault();--}}
{{--                var reply_email_form_data = $(this).serialize();--}}

{{--                $('#loadingOverlay').show();--}}
{{--                $.ajax({--}}
{{--                    type : 'POST',--}}
{{--                    url : '{{ route('reply_by_email_post') }}',--}}
{{--                    data : reply_email_form_data,--}}
{{--                    success : function (data) {--}}
{{--                        if (data.status == 1){--}}
{{--                            toastr.success(data.msg, '@lang('app.success')', toastr_options);--}}
{{--                        }else {--}}
{{--                            toastr.error(data.msg, '@lang('app.error')', toastr_options);--}}
{{--                        }--}}
{{--                        $('#replyByEmail').modal('hide');--}}
{{--                        $('#loadingOverlay').hide();--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}

{{--            $(document).on('click', '.comments-list .fa-reply', function(e){--}}
{{--                e.preventDefault();--}}

{{--                var comment_id = $(this).closest('.comment-box').attr('data-comment-id');--}}
{{--                var reply_form = $('.post-comments-form').html();--}}
{{--                reply_form += '<a href="javascript:;" class="text-danger reply_form_remove"><i class="fa fa-times"> </a>';--}}

{{--                //reply_form_box--}}
{{--                $(this).closest('.comment-box').find('.reply_form_box').html(reply_form).show().find('.comment_id').val(comment_id);--}}

{{--            });--}}

{{--            $(document).on('click', '.reply_form_remove', function(e) {--}}
{{--                e.preventDefault();--}}
{{--                $(this).closest('form').remove();--}}
{{--                $(this).closest('.reply_form_box').hide();--}}
{{--            });--}}

{{--        });--}}
{{--    </script>--}}

@endsection
