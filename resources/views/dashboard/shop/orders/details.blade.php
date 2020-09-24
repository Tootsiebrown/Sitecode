@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Order {{ $order->sequence }}</h1>

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
                    <th>Item  ID</th>
                    <th>Bin</th>
                    <th>Status</th>
                    <th>Toggle</th>
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
                        <td>
                            {{ $item->listingItems->first()->id }}
                        </td>
                        <td>
                            {{ $item->listingItems->first()->bin }}
                        </td>
                        <td>
                            {{ $item->listingItems->first()->removed_at ? 'removed' : 'in-bin' }}
                        </td>
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
@endsection
