<a href="/cart" class="btn btn-link nav-cart__button" data-element="link">
    <span class="nav-cart__count">{{ $items->count() }}</span>
    @svg(cart)
    <span>My Cart</span>
</a>
<div class="nav-cart">
    @if ($items->count() > 0)
        <ul>
            @foreach ($items as $item)
                <li>
                    <div class="nav-cart__item-header">
                        <p>{{ $item->name }}</p>
                        <form action="{{ route('shop.cart.delete', ['itemId' => $item->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-link">@svg(trash)</button>
                        </form>
                    </div>
                    <div class="nav-cart__item-details">
                        <p>${{ $item->gross_unit_price }}</p>
                        <p>Qty: {{ $item->quantity }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
        <a class="nav-cart__link btn btn-secondary" href="{{ route('shop.checkout.start') }}">
            Checkout
            @svg(cart)
        </a>
        <a class="nav-cart__link btn btn-primary" href="{{ route('shop.cart.index') }}">
            Edit My Cart
            @svg(edit)
        </a>
    @else
        <p>No items in your cart</p>
    @endif
</div>
