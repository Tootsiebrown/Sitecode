@extends ('layouts.app')

@section('content')
    @php
        $shipment = $order->default_shipment;
        $payment = $order->payments->first();
    @endphp
    <div class="container">
        @include ('shop.checkout.breadcrumbs')
        @render(App\ViewComponents\CheckoutFlowComponent::class)

        <div class="checkout__body">
            @render(App\ViewComponents\CheckoutCartComponent::class)
            <div class="checkout__main checkout__confirmation">
                <h1>Your order is on the way!</h1>
                <p>An email receipt has been sent your way. Thanks for shopping with us!</p>

                <div class="confirmation">
                    <div class="confirmation__details">
                        <p class="label">Order Number:</p>
                        <p>{{ $order->sequence }}</p>

                        <p class="label">Shipping To:</p>
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

                        <p class="label">Payment</p>
                        <p>
                            {{ $payment->firstname }} {{ $payment->lastname }}<br>
                            {{ $payment->address1 }}<br>
                            @if ($payment->address2)
                                {{ $payment->address2 }}
                            @endif
                            {{ $payment->city }}, {{ $payment->state }} {{ $payment->zip }}
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
