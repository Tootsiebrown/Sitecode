<div class="checkout__cart" data-component="checkout-sidebar-cart">
    @if (is_null($order->placed_at))
        <div class="checkout__cart-link">
            <a href="{{ route('shop.cart.index') }}">
                Edit Cart
            </a>
        </div>
    @endif
    <ul class="checkout-cart">
        @foreach($order->items as $item)
            <li>
                <a href="{{ $item->listing->url }}">
                    {{ $item->listing->title }}
                </a>

                <div class="checkout-cart__details">
                    <div class="checkout-cart__price">
                        {{ Currency::format($item->gross_unit_price) }}
                    </div>
                    <div class="checkout-cart__quantity">
                        Qty: <span>{{ $item->quantity }}</span>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

        @if (config('shipping.custom_shipping'))
            <h4 class="checkout-cart__tax">Shipping: {{ Currency::format($order->shipping_subtotal) }}</h4>
        @else
            <h4 class="checkout-cart__tax">Shipping: {{ $order->validateShipping() ? Currency::format($order->shipping_subtotal) : 'TBD' }}</h4>
        @endif

        <div class="checkout-cart__discount">
            @if ($order->coupons->isNotEmpty())
                <h4>Discount: {{ Currency::format($order->coupon_value) }}</h4>
                @foreach($order->coupons as $coupon)
                    <div class="checkout-cart__discount-details" data-component="cart-coupon" data-code="{{ $coupon->code }}">
                        <h3>
                            Code: {{ $coupon->code }} |
                            {{ $order->coupon->dollars ? Currency::format($coupon->calculated_value) : $coupon->percent . '%' }}
                        </h3>
                        @if (is_null($order->placed_at))
                            <form class="solo-button remove-code" action="{{ route('shop.checkout.removeCode', ['code' => $coupon->code]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button data-element="remove-coupon" class="btn btn-default" name="submit" value="submit">Remove</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            @endif
            @if (! $order->placed_at)
                @if (isset($couponMessage))
                    <h3 class="alert alert-danger">{{ $couponMessage }}</h3>
                @endif
                <form class="form-inline form-standalone checkout-cart__promo apply-code" action="{{ route('shop.checkout.applyCode') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="code" class="form-control" placeholder="promo code">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" data-element="apply-code">Apply</button>
                            </span>
                        </div>
                    </div>
                </form>
            @endif
        </div>
        <h4 class="checkout-cart__tax">Tax: {{ $order->validateTax() ? '$' . $order->tax_subtotal : 'TBD' }}</h4>

    <div class="checkout-cart__total">
        <h3>Total</h3>
        <div class="checkout-cart__subtotal @if(empty($cta)) --no-cta @endif">
            {{ Currency::format($order->total) }}
            <div class="pointless">
        </div>
        @if (!empty($cta))
            <a href="{{ $cta['url'] }}" class="checkout-cart__continue">{{ $cta['text'] }}</a>
        @endif
    </div>
</div>
