<div class="checkout__cart">
    <div class="checkout__cart-link">
        <a href="{{ route('shop.cart.index') }}">
            Edit Cart
        </a>
    </div>
    <ul class="checkout-cart">
        @foreach($order->items as $item)
            <li>
                <a href="{{ $item->listing->url }}">
                    {{ $item->listing->title }}
                </a>
                <div class="checkout-cart__details">
                    <div class="checkout-cart__price">
                        ${{ $item->unit_price }}
                    </div>
                    <div class="checkout-cart__quantity">
                        Qty: <span>{{ $item->quantity }}</span>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <h3>Subtotal</h3>
    <div class="checkout-cart__subtotal">
        ${{ $order->item_gross_subtotal }}
    </div>
    <a href="{{ route('shop.checkout.showBilling') }}" class="checkout-cart__continue">Continue to Payment</a>
</div>
