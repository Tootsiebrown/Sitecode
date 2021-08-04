@extends('layouts.app')
@section('title') @if( ! empty($title)) {{ strip_tags($title) }} | @endif @parent @endsection<div>

@section('social-meta')
    <meta property="og:title" content="{{ safe_output($listing->title) }}">
    <meta property="og:description" content="{{ substr(trim(preg_replace('/\s\s+/', ' ',strip_tags($listing->description) )),0,160) }}">
    @if($listing->featured_image)
        <meta property="og:image" content="{{ $listing->featured_image->url }}">
        <meta property="og:image:width" content="{{ $listing->featured_image->width }}">
        <meta property="og:image:height" content="{{ $listing->featured_image->height }}">
    @endif
    <meta property="og:url" content="{{  route('singleListing', [$listing->id, $listing->slug]) }}">
    <meta name="twitter:card" content="summary_large_image">
    <!--  Non-Essential, But Recommended -->
    <meta property="og:site_name" content="{{ get_option('site_name') }}">
    <meta property="og:type" content="product" />
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
                    <h3> {{ safe_output($listing->title) }}</h3>
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

                    <div class="single-ad__condition">{{ $listing->condition }}</div>
                    @if ($listing->is_auction)
                        @if($listing->is_bidding_active)
                            <p class="single-ad__time-limit">
                                Bid Deadline: {{$listing->bid_deadline() }}<br>
                                Closes {{ $listing->bid_deadline_left() }}.
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
                                    <i class="fa fa-exclamation-circle"></i>
                                    You&rsquo;ll need to <a href="{{ route('login', ['back' => $listing->url]) }}">sign in</a>
                                    or <a href="{{ route('register', ['back' => $listing->url]) }}">register</a> before bidding.',
                                </div>
                            @else
                                <form action="{{ route('post_bid', $listing->id) }}" class="form-inline form-standalone place-bid" method="post" enctype="multipart/form-data" novalidate>
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
                            <form action="{{ route('shop.cart.add') }}" class="form-inline form-standalone place-bid" method="post" enctype="multipart/form-data" novalidate>
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
                            <div class="share-widget dark">
    <div class="share-widget-sub">
      <div class="share-widget-title">
        <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'>
          <path d='M384 336a63.78 63.78 0 00-46.12 19.7l-148-83.27a63.85 63.85 0 000-32.86l148-83.27a63.8 63.8 0 10-15.73-27.87l-148 83.27a64 64 0 100 88.6l148 83.27A64 64 0 10384 336z' />
        </svg>
        <div>
          SHARE
        </div>
      </div>
<script>
    function socialWindow(url) {
    var left = (screen.width - 570) / 2;
    var top = (screen.height - 570) / 2;
    var params = "menubar=no,toolbar=no,status=no,width=570,height=570,top=" + top + ",left=" + left;
    window.open(url,"NewWindow",params);
}

    function fbshareCurrentPage()
    {window.open("https://www.facebook.com/sharer/sharer.php?u="+encodeURIComponent(window.location.href)+"&t="+document.title, '',
    'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
    return false; }

    // function twittershareCurrentPage()
    // {window.open("https://twitter.com/intent/tweet?url="+encodeURIComponent(window.location.href)+"&t="+document.title, '',
    // 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
    // return false; }


</script>
      <div class="share-widget-icons">

        <!-- facebook -->
        <a href="https://www.facebook.com/sharer.php?u=" onclick="fbshareCurrentPage()"  target="_blank">
          <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'>
            <path d='M480 257.35c0-123.7-100.3-224-224-224s-224 100.3-224 224c0 111.8 81.9 204.47 189 221.29V322.12h-56.89v-64.77H221V208c0-56.13 33.45-87.16 84.61-87.16 24.51 0 50.15 4.38 50.15 4.38v55.13H327.5c-27.81 0-36.51 17.26-36.51 35v42h62.12l-9.92 64.77H291v156.54c107.1-16.81 189-109.48 189-221.31z' fill-rule='evenodd' />
          </svg>
        </a>

        <!-- twitter -->
        <!-- <a href="https://twitter.com/intent/tweet?url=" onclick="twittershareCurrentPage()" target="_top">
          <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'>
            <path d='M496 109.5a201.8 201.8 0 01-56.55 15.3 97.51 97.51 0 0043.33-53.6 197.74 197.74 0 01-62.56 23.5A99.14 99.14 0 00348.31 64c-54.42 0-98.46 43.4-98.46 96.9a93.21 93.21 0 002.54 22.1 280.7 280.7 0 01-203-101.3A95.69 95.69 0 0036 130.4c0 33.6 17.53 63.3 44 80.7A97.5 97.5 0 0135.22 199v1.2c0 47 34 86.1 79 95a100.76 100.76 0 01-25.94 3.4 94.38 94.38 0 01-18.51-1.8c12.51 38.5 48.92 66.5 92.05 67.3A199.59 199.59 0 0139.5 405.6a203 203 0 01-23.5-1.4A278.68 278.68 0 00166.74 448c181.36 0 280.44-147.7 280.44-275.8 0-4.2-.11-8.4-.31-12.5A198.48 198.48 0 00496 109.5z' />
          </svg>
        </a> -->

        <!-- email -->
        <!-- <a href="mailto:?subject=CatchnDealz&body=" target="_blank">
          <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'>
            <path d='M476.59 227.05l-.16-.07L49.35 49.84A23.56 23.56 0 0027.14 52 24.65 24.65 0 0016 72.59v113.29a24 24 0 0019.52 23.57l232.93 43.07a4 4 0 010 7.86L35.53 303.45A24 24 0 0016 327v113.31A23.57 23.57 0 0026.59 460a23.94 23.94 0 0013.22 4 24.55 24.55 0 009.52-1.93L476.4 285.94l.19-.09a32 32 0 000-58.8z' />
          </svg>
        </a> -->
      </div>
    </div>
  </div>
  <style>
      .share-widget-sub {
    margin-bottom: 20px;
}
/* END */


.share-widget-sub .share-widget-title {
    display: flex;
    justify-content: center;
    align-items: center;
}

.share-widget-sub .share-widget-title svg {
    width: 20px;
    margin-right: 10px;
}

.share-widget-sub .share-widget-title div {
    font-size: 14px;
    letter-spacing: 1px;
}

.share-widget-sub a {
    text-decoration: none;
}


.share-widget-sub a svg {
    width: 24px;
    margin: 7px;
    transition: .2s ease-in-out;
}

.share-widget-sub a svg:hover {
    transform: scale(1.1);
    transition: .2s ease-in-out;
}




/* FLIP ANIMATION */
.share-widget {
    perspective: 400px;
    width: 220px;
    height: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.share-widget .share-widget-sub {
    width: 100%;
    max-width: 400px;
    -webkit-transform-style: preserve-3d;
    transform-style: preserve-3d;
    transition: -webkit-transform 0.6s;
    -webkit-transition: -webkit-transform 0.6s;
    transition: transform 0.6s;
    transition: transform 0.6s, -webkit-transform 0.6s;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
}

.share-widget-sub .share-widget-title,
.share-widget-sub .share-widget-icons {
    position: absolute;
    width: 100%;
    height: 50px;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-font-smoothing: antialiased;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
}

.share-widget-sub .share-widget-icons {
    -webkit-transform: rotateX(180deg);
    transform: rotateX(180deg);
}

.share-widget-sub.flipped {
    -webkit-transform: rotateX(180deg);
    transform: rotateX(180deg);
}


/* LIGHT & DARK STYLES */
.share-widget.dark .share-widget-sub a svg {
    fill: var(--light-color);
}

.share-widget.light .share-widget-sub a svg {
    fill: var(--dark-color);
}

.share-widget.light .share-widget-sub .share-widget-title,
.share-widget.light .share-widget-sub .share-widget-icons {
    background-color: var(--light-color);
}

.share-widget.dark .share-widget-sub .share-widget-title,
.share-widget.dark .share-widget-sub .share-widget-icons {
    background-color: var(--dark-color);
}

.share-widget.light .share-widget-sub {
    color: var(--dark-color);
}

.share-widget.dark .share-widget-sub {
    color: var(--light-color);
}

.share-widget.light .share-widget-sub .share-widget-title svg {
    fill: var(--dark-color);
}

.share-widget.dark .share-widget-sub .share-widget-title svg {
    fill: var(--light-color);
}

/* FULL STYLE */

.share-widget.full .share-widget-sub .share-widget-title div::after {
    content: 'ON SOCIAL MEDIA'
}

.share-widget.full {
    width: 400px;
}

.share-widget.full .share-widget-sub {
    flex-direction: column;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    cursor: default;

}

.share-widget.full .share-widget-sub .share-widget-title,
.share-widget.full .share-widget-sub .share-widget-icons {
    position: relative;
    transform: none;
    box-shadow: none;
}

.share-widget.full .share-widget-sub .share-widget-title svg{
    display: none;
}
  </style>
  <script>
      let shareWidgies = document.querySelectorAll('.share-widget:not(.full) .share-widget-sub');

shareWidgies.forEach(el => {
    el.addEventListener('click', function () {
        if (this.classList.contains('flipped')) {
            this.classList.remove('flipped');
        } else {
            this.classList.add('flipped');
        }
    });
});

  </script>
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
                            @elseif ($listing->availableItems()->count() > 0 && $listing->offers_enabled)
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
                            <p>Please <a href="{{ route('login', ['back' => $listing->url]) }}">Login</a> if you want to make an offer</p>
                        @endif
                    @endif
                </div>
                <div class="single-ad__images">
                    <div class="auction-img-video-wrap">
                        @if ( ! $listing->is_published())
                            <div class="alert alert-warning"> <i class="fa fa-warning"></i> @lang('app.ad_not_published_warning')</div>
                        @endif
                        @if( ! empty($listing->video_url))
                            @php
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
                            @endphp
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

            <div>
            <h3 class="recommended">Recommended Items</h3>
            </div>
            <br><br><br><br>
            <div class="flex-container1">
            <?php
            // this is our querry for pulling recommended items -KE
            $question = "SELECT listings.id,listing_items.listing_id,reserved_for_order_id,title,price,slug,ebay_order_id,media_name, listing_images.listing_id
            from listings, listing_items, listing_images
            where listings.id=listing_items.listing_id and reserved_for_order_id is NULL and ebay_order_id is NULL and listings.id=listing_images.listing_id
            ORDER BY rand() limit 4";

            //This connects to the DB while keeping the loggin information safe. -KE
            $result = DB::select($question);

            //This grabs the data from the array -KE
            foreach ($result as $row) {
                    echo "<div class='recItems'>";
                    echo $row->title;
                    echo "<br>";
                    $image_name = $row->media_name;
                    $image_url = "/storage/uploads/listings/" . $image_name;
                    echo "</br>";
                    echo "<div>";
                    echo "<img id='testImage' src='$image_url'></img>";
                    echo "</div>";
                    echo "</br>";
                    $link_listing_sku = $row->id;
                    $link_listing_slug = $row->slug;
                    $link_address = "auction" . "/" . $link_listing_sku . "/" . $link_listing_slug;
                    echo "<div> <a href='/$link_address'></div><button class='btnRecommended'>Check This Out!</button></a>";
                    echo "</div>";
            }
            ?>
            </div>

            <div class="related-ads">
                @if($relatedListings->count() > 0 && get_option('enable_related_ads') == 1)
                    <div class="widget similar-ads">
                        <h3>@lang('app.similar_ads')</h3>

                        @foreach($relatedListings as $rad)
                            <div class="item-loop">

                                <div class="ad-box">
                                    <div class="ads-thumbnail">
                                        <a href="{{ route('singleListing', [$rad->id, $rad->slug]) }}">
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
                                            <a class="ad-box-title" href="{{ route('singleListing', [$rad->id, $rad->slug]) }}" title="{{ $rad->title }}">
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
                                        <a href="{{ route('singleListing', [$rad->id, $rad->slug]) }}" class="btn btn-primary">@lang('app.place_bid')</a>
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
    <div class="banner-message container-fluid">
  <div class="marquee">
  <h3><i class="fas fa-exclamation-triangle"></i> SITE WIDE DISCOUNTS - 50% OFF ALL ITEMS EXCLUDING MYSTERY BOXS, HIGH END ELECTRONICS, AND WHOLESALE CATEGORIES! <i class="fas fa-exclamation-triangle"></i></h3>
  </div>

  <div class="marquee">
    <h3 id="secondmessage"> <i class="fas fa-money-bill-wave" id="money"></i> Use code Save50% and start saving today! <i class="fas fa-money-bill-wave"id="money"></i> </h3>
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
{{--            url: '{{  route('singleListing', [$listing->id, $listing->slug]) }}', // link on shared page--}}
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
@if (!$listing->is_auction)
<script>
    // Set the expiry date
    var expired_at = moment("{!! $listing->expired_at ? $listing->expired_at->toDateTimeString() : '00:00:00' !!}").format('x')

    // Update the count down every 1 second
    var x = setInterval(function() {
        var now = moment(moment().tz('America/New_York').format("YYYY-MM-DD HH:mm:ss")).format('x')
      // Get time now
      var distance = expired_at - now
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
      // Display the result in the element with id="count-down"
      document.getElementById("count-down").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";
      // If the count down is finished, write some text
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("count-down").innerHTML = "EXPIRED";
      }
    }, 1000);
</script>
@endif
@endsection
