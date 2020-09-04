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
                <ul>
                    @foreach ($order->items as $item)
                        <li class="checkout-cart-list-item">
                            <div class="checkout-cart-list-item__image-container">
                                <img src="{{ $item->listing->featured_image->url }}" alt="{{ $item->title }}">
                            </div>
                            <div class="checkout-cart-list-item__main">
                                <p class="checkout-cart-list-item__name">{{ $item->name }}</pcheckout-cart-list-item>
                                <p>${{ $item->gross_unit_price }}</p>
                                <p>Qty: {{ $item->quantity }}</p>
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
            </div>
        </div>
    </div>
@endsection
