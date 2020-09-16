<div class="listing-boxes__container @if (!isset($container) || $container === true) container @endif">
    @foreach($listings as $listing)
        <div class="listing-boxes__listing">
            <div class="ads-thumbnail">
                <a href="{{ route('single_ad', [$listing->id, $listing->slug]) }}">
                    @if ($listing->featured_image)
                        <img itemprop="image"  src="{{ $listing->featured_image->thumb_url }}" class="img-responsive" alt="{{ $listing->title }}">
                    @endif
                </a>
            </div>

            <div class="listing-boxes__listing-title">
                <a class="" href="{{ route('single_ad', [$listing->id, $listing->slug]) }}" title="{{ $listing->title }}">
                    {{ str_limit($listing->title, 40) }}
                </a>
            </div>

            <div class="listing-boxes__listing-prices">
                @if ($listing->is_auction)
                    <div class="price-row">
                        @lang('app.current_bid'): <span class="btn btn-primary">{!! themeqx_price($listing->current_bid()) !!}</span>
                    </div>
                    <div class="price-row">
                        Or buy it now for: <span class="btn btn-primary">{!! themeqx_price($listing->buy_it_now_price) !!}</span>
                    </div>
                @else
                    <div class="price-row">
                        Price: <span class="btn btn-primary">${{ $listing->price }}</span>
                    </div>
                @endif
            </div>

            {{-- <div class="countdown" data-expire-date="{{$listing->expired_at}}" ></div>--}}
            {{--<div class="place-bid-btn">
                <a href="{{ route('single_ad', [$listing->id, $listing->slug]) }}" class="btn btn-primary">@lang('app.place_bid')</a>
            </div> --}}

            @if ($listing->is_auction)
                <a
                  class="listing-boxes__listing-bottom listing-boxes__listing-watch"
                  href="#"
                  data-component="watch-listing"
                  data-slug="{{ $listing->slug }}"
                >
                    @if( ! $listing->is_my_favorite())
                        @lang('app.save_ad_as_favorite') <i class="fa fa-eye"></i>
                    @else
                        @lang('app.remove_from_favorite') <i class="fa fa-eye-slash"></i>
                    @endif
                </a>
            @else
                <form
                  class="listing-boxes__listing-cart listing-boxes__listing-bottom"
                  data-component="listing-box-cart"
                  action="{{ route('shop.cart.add') }}"
                  method="POST"
                >
                    @csrf
                    <input type="hidden" name="customizations[1]" value="{{ $listing->id }}">
                    <input type="hidden" name="product_id" value="1">
                    <input type="hidden" name="quantity" value="1">
                    <input type="submit" name="submit" value="Add to Cart">
                </form>
            @endif

        </div>
    @endforeach
</div>
