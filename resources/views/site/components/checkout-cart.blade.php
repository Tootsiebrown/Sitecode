<div class="checkout__cart">
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
                        {{ Currency::format($item->unit_price) }}
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
        <h4 class="checkout-cart__tax">Tax: {{ $order->validateTax() ? '$' . $order->tax_subtotal : 'TBD' }}</h4>

    <h3>Total</h3>
    <div class="checkout-cart__subtotal @if(empty($cta)) --no-cta @endif">
        {{ Currency::format($order->gross_total) }}
    </div>
    @if (!empty($cta))
        <a href="{{ $cta['url'] }}" class="checkout-cart__continue">{{ $cta['text'] }}</a>
    @endif
</div>
