@extends ('layouts.app')


@section('google-analytics-datalayer')
    <script>
        dataLayer.push({
            // 'event' : 'eec.purchase',
            'ecommerce': {
                'purchase': {!! json_encode($googleAnalyticsDataLayer) !!}
            }
        });
    </script>
@endsection

@section('content')
    @php
        /** @var $order \App\Wax\Shop\Models\Order  */

        $shipment = $order->default_shipment;
        $payment = $order->payments->first();
    @endphp
    <div class="container">
        @include ('shop.checkout.breadcrumbs')
        @render(App\ViewComponents\CheckoutFlowComponent::class)

        <div class="checkout__body">
            @include ('site.components.checkout-cart', [
                'order' => $order,
                'shipment' => $shipment,
                'cta' => [
                    'url' => route('home'),
                    'text' => 'Keep Shopping'
                ],
                'cartEditable' => false
            ])
            <div class="checkout__main checkout__confirmation">
                <h1>Your order is on the way!</h1>
                <p>An email receipt has been sent your way. Thanks for shopping with us!</p>

                <div class="confirmation">
                    <div class="confirmation__details">
                        <h5>Order Number:</h5>
                        <p>{{ $order->sequence }}</p>

                        <h5>Shipping To:</h5>
                        @if ($shipment->in_store_pickup)
                            <p>In Store Pickup</p>
                        @else
                            <p>
                                {{ $shipment->firstname }} {{ $shipment->lastname }}<br>
                                {{ $shipment->address1 }}<br>
                                @if ($shipment->address2)
                                    {{ $shipment->address2 }}<br>
                                @endif
                                {{ $shipment->city }}, {{ $shipment->state }} {{ $shipment->zip }}
                            </p>
                        @endif

                        <h5>Billing</h5>
                        <p>
                            {{ $payment->firstname }} {{ $payment->lastname }}<br>
                            {{ $payment->address1 }}<br>
                            @if ($payment->address2)
                                {{ $payment->address2 }}
                            @endif
                            {{ $payment->city }}, {{ $payment->state }} {{ $payment->zip }}
                        </p>

                        <h5>Payment</h5>
                        <p>
                            {{ $payment->brand }}<br/>
                            Ending in: {{ $payment->account }}
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
