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
                    <th>
                        Product Name
                    </th>
                    <th>
                        Quantity
                    </th>
                    <th>
                        Unit Price
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($shipment->items as $item)
                    <tr data-id="$item['id']">
                        <td class="cartitem-name">
                            {{ $item->name }}
                            @foreach ($item->options as $option)
                                {{ $option->name }}: {{ $option->value }}
                            @endforeach
                        </td>
                        <td class="cartitem-quantity">
                            {{ $item->quantity }}
                        </td>
                        <td class="cartitem-unit-price">
                            {{ Currency::format($item->gross_unit_price) }}
                        </td>
                    </tr>
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
            @include ('dashboard.orders.payments.' . str_replace('_', '-', $payment->type), [
                'payment' => $payment
            ])
        @endforeach
    </section>
@endsection
