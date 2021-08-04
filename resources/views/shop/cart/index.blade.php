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
                    {{ Currency::format($order->item_gross_subtotal) }}
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
                                    @if (isset($item->listing->featured_image->url))
                                        <img src="{{ $item->listing->featured_image->url }}" alt="{{ $item->name }}">
                                    @endif
                                </div>
                                <div class="checkout-cart-list-item__main">
                                    <p class="checkout-cart-list-item__name">{{ $item->name }}</p>
                                    <p>${{ $item->gross_unit_price }}</p>
                                    @if ($item->offer)
                                        <i>Cannot change the quantity of an accepted offer.</i>
                                    @elseif ($item->listing->is_auction)
                                        <i>Cannot change the quantity of an auction.</i>
                                    @else
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
                                    @endif
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
</div>
@endsection
