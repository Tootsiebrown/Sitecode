@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="shop-order-details">
        <h1>
            Order {{ $order->sequence }}
            @if ($order->canceled)
                <span class="alert alert-danger">CANCELED</span>
            @endif
        </h1>

        <section>
            <p><strong>Status:</strong></p>
            <ul class="order-status">
                <li class="{{ $order->placed_at ? 'done' : '' }}">Placed</li>
                <li class="{{ $order->processed_at ? 'done' : '' }}">Processed</li>
                <li class="{{ $order->default_shipment->shipped_at ? 'done' : '' }}">Shipped</li>
            </ul>
        </section>

        @if (is_null($order->default_shipment->shipped_at))
            <section>
                <p><strong>Mark As:</strong></p>
                <form method="POST" action="{{ route('dashboard.shop.orders.status', ['id' => $order->id]) }}">
                    @csrf
                    <select name="status">
                        <option></option>
                        <option value="processed" @if(!$order->processed_at) selected @endif>Processed</option>
                        <option value="shipped" @if($order->processed_at && !$order->default_shipment->shipped_at) selected @endif>Shipped</option>
                    </select>
                    <br><br>
                    <input type="submit" class="btn btn-primary" name="mark" value="Submit">
                </form>
            </section>
        @endif

        @foreach ($order->shipments as $shipment)
            <section>
                <p>
                    <strong>Ship To:</strong><br>
                    @if ($shipment->in_store_pickup)
                        In-store-pickup
                    @else
                        {!! \Wax\Data::formatAddress($shipment, true) !!}
                    @endif
                </p>
                <table class="order-details__cart dashboard-table" id="">
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Listing ID</th>
                        @if (!$order->canceled)
                            <th>Item  ID</th>
                            <th>Bin</th>
                            <th>Status</th>
                            @if (!$order->shipped)
                                <th>Toggle</th>
                            @endif
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($shipment->items as $item)
                        <tr data-id="$item['id']">
                            <td class="cartitem-name" rowspan="{{ $item->listingItems->count() }}">
                                {{ $item->name }}
                                @foreach ($item->options as $option)
                                    {{ $option->name }}: {{ $option->value }}
                                @endforeach
                            </td>
                            <td class="cartitem-quantity" rowspan="{{ $item->listingItems->count() }}">
                                {{ $item->quantity }}
                            </td>
                            <td class="cartitem-unit-price" rowspan="{{ $item->listingItems->count() }}">
                                {{ Currency::format($item->gross_unit_price) }}
                            </td>
                            <td class="numeric" rowspan="{{ $item->listingItems->count() }}">
                                {{ $item->listing_id }}
                            </td>
                            @if (! $order->canceled)
                                <td>
                                    {{ $item->listingItems->first()->id }}
                                </td>
                                <td>
                                    {{ $item->listingItems->first()->bin }}
                                </td>
                                <td>
                                    {{ $item->listingItems->first()->removed_at ? 'removed' : 'in-bin' }}
                                </td>
                                @if (!$order->shipped)
                                    <td>
                                        <form
                                            id="toggle-item-bin"
                                            method="POST"
                                            action="{{ route('dashboard.shop.orders.items.toggle-removed', ['orderId' => $order->id, 'itemId' => $item->listingItems->first()->id]) }}"
                                        >
                                            @csrf
                                            <input type="hidden" name="current_status" value="{{ $item->listingItems->first()->removed_at ? '1' : '0' }}">
                                            <input class="btn btn-primary" type="submit" name="action" value="toggle">
                                        </form>
                                    </td>
                                @endif
                            @endif
                        </tr>
                        @foreach ($item->listingItems as $listingItem)
                            @if ($loop->first)
                                @continue
                            @endif
                            <tr>
                                <td>
                                    {{ $listingItem->id }}
                                </td>
                                <td>
                                    {{ $listingItem->bin }}
                                </td>
                                <td>
                                    {{ $listingItem->removed_at ? 'removed' : 'in-bin' }}
                                </td>
                                <td>
                                    <form
                                        id="toggle-item-bin"
                                        method="POST"
                                        action="{{ route('dashboard.shop.orders.items.toggle-removed', ['orderId' => $order->id, 'itemId' => $listingItem->id]) }}"
                                    >
                                        @csrf
                                        <input type="hidden" name="current_status" value="{{ $listingItem->removed_at ? '1' : '0' }}">
                                        <input type="submit" name="action" value="toggle">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </section>
        @endforeach
        <section>
            <h3>Total</h3>
            <ul>
                @if ($order->gross_total != $order->total)
                    <li>Cart Subtotal: {{ Currency::format($order->gross_total) }}</li>
                @endif

                @if ($order->shipping_gross_subtotal > 0)
                    <li>Shipping Subtotal: {{ Currency::format($order->shipping_gross_subtotal) }}</li>
                @endif

                @if ($order->tax_subtotal > 0)
                    <li>Tax Subtotal: {{ Currency::format($order->tax_subtotal) }}</li>
                @endif

                @foreach ($order->bundles as $bundle)
                    <li>{{ $bundle->name }}: {{ Currency::format($bundle->calculated_value) }}</li>
                @endforeach

                @if (!empty($order->coupon))
                    <li>{{ $order->coupon->title }} '{{ $order->coupon->code }}': {{ Currency::format($order->coupon->calculated_value) }}</li>
                @endif

                <li>Total: {{ Currency::format($order->total) }}</li>
            </ul>
        </section>
        <section>
            <h3>Payment Details</h3>

            @foreach ($order->payments as $payment)
                @include ('dashboard.shop.orders.payments.' . str_replace('_', '-', $payment->type), [
                    'payment' => $payment
                ])
            @endforeach
        </section>

        @if ($order->canceled)
            <h3 class="alert alert-danger">ORDER CANCELED</h3>
            <p>By: {{ $order->canceledBy->email }}</p>
            <p>At: {{ $order->canceled_at }}</p>
        @else
            <section>
                <h3>Cancel Order</h3>
                <p>
                    This cannot be undone. This will remove the items from the order and place them back into purchasable
                    inventory. To re refund orders, go to <a href="https://stripe.com">stripe.com</a>.
                    To modify shipping, go to <a href="https://shipstation.com">shipstation.com</a>.
                </p>
                <form
                  method="POST"
                  action="{{ route('dashboard.shop.orders.cancel', ['id' => $order->id]) }}"
                  data-component="cancel-order"
                  class="solo-button"
                >
                    @csrf
                    <input
                      type="submit"
                      name="cancel"
                      value="Cancel Order"
                      class="btn btn-secondary"
                    >
                </form>
            </section>
        @endif
    </div>
@endsection
