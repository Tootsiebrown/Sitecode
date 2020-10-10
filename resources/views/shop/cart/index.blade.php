@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="breadcrumbs">
                        <a href="{{ route('home') }}">Home</a>

                        <span>My Cart</span>
                    </div>
                </div>
            </div>
        </div>
        @render(App\ViewComponents\CheckoutFlowComponent::class)

        <div class="checkout__body">
            <div class="checkout__cart">

                <h3>Subtotal</h3>
                <div class="checkout-cart__subtotal">
                    ${{ $order->item_gross_subtotal }}
                </div>
                <a href="{{ route('shop.checkout.showShipping') }}" class="checkout-cart__continue">Checkout @svg(cart)</a>
            </div>
            <div class="checkout__main checkout__cart-page">
                @include('dashboard.flash_msg')
                {!! $errors->has('quantity')? '<div class="alert alert-danger">'.$errors->first('quantity').'</div>':'' !!}
                @if ($order->items->count() > 0)
                    <ul>
                        @foreach ($order->items as $item)
                            <li class="checkout-cart-list-item">
                                <div class="checkout-cart-list-item__image-container">
                                    <img src="{{ $item->listing->featured_image->url }}" alt="{{ $item->name }}">
                                </div>
                                <div class="checkout-cart-list-item__main">
                                    <p class="checkout-cart-list-item__name">{{ $item->name }}</p>
                                    <p>${{ $item->gross_unit_price }}</p>
                                    <form class="cart-quantity-form" data-component="cart-item-quantity" method="POST" action="{{ route('shop.cart.update') }}">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <span class="input-group-addon">Qty: </span>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="item-{{ $item->id }}-qty"
                                                value="{{ $item->quantity }}"
                                                name="item[{{ $item->id }}]"
                                                placeholder=""
                                                data-element="input"
                                                data-original-quantity="{{ $item->quantity }}"
                                            >
                                            <span class="input-group-btn">
                                                <button
                                                    class="btn btn-link"
                                                    type="submit"
                                                    data-element="button"
                                                >
                                                    Update
                                                </button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <div class="checkout-cart-list-item__actions">
                                    <form action="{{ route('shop.cart.delete', ['itemId' => $item->id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-link">@svg(trash)</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <h2>Cart is empty. Please continue shopping.</h2>
                @endif
            </div>
        </div>
    </div>
@endsection
