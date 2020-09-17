@extends('admin::layouts.base')

@section('head')
    <!--
        NOTE: I'm doing this embedded style as a temporary hack. I expect a fed will want to rip this out
        and overhaul the css and probably the markup.
    -->
    <style type="text/css">
        section {
            margin-top: 30px;
            margin-bottom: 10px;
        }
        #cart-summary thead th {
            text-align: left;
        }
        ul {
            list-style-type: none;
        }
    </style>
@endsection

@section('body')
    <div class="cms-edit-box group">
        <div class="edit-heading icon-edit">
            <div style="float: right;">
                <a target="_blank" href="{{ route('shop::orderDetails.print', ['id' => $id]) }}">Print Order</a>
            </div>
            {{ $page['title'] }}
        </div>
        <div class="edit_body group">
            @if (!empty($errors))
                @include('admin::components.shared.error-list', ['errors' => $errors])
            @endif

            @if (!empty($notes))
                @include('admin::components.shared.notes', ['notes' => $notes])
            @endif

            <div class="cms-col-wide">
                @include ('shop::components.admin.order-details.header', ['order' => $order])

                @foreach ($order->shipments as $shipment)
                    <section>
                        @if ($order->shipments->count() > 1)
                            <h3>Shipment {{ $loop->iteration }}</h3>
                        @endif
                        <p>
                            <strong>Ship To:</strong><br>
                            @if ($shipment->in_store_pickup)
                                In-store-pickup
                            @else
                                {!! \Wax\Data::formatAddress($shipment, true) !!}
                            @endif
                        </p>
                        @include ('shop::components.admin.order-details.cart', ['shipment' => $shipment])
                        @include ('shop::components.admin.order-details.shipment-details', ['shipment' => $shipment])

                    </section>
                @endforeach

                @include ('shop::components.admin.order-details.totals', ['order' => $order])

                @include ('shop::components.admin.order-details.payment-details', ['order' => $order])
            </div>

            <div class="cms-col-thin">
                <div class="edit-container">
                    <label class="cmsFieldLabel">@if (! is_null($order->processed_at)) Undo @endif Mark As Processed</label>
                    <div class="body-container">
                        <div class="">
                            <form action="{{ route('shop::orderDetails.markProcessed', ['id' => $order->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="processed" value="{{ is_null($order->processed_at) ? 1 : 0 }}">
                                <button class="button" type="submit" name="action">{{ is_null($order->processed_at) ? '' : 'NOT' }} Processed</button>
                            </form>
                        </div>
                    </div>
                </div>

                @if ($order->payments()->authorized()->get()->isNotEmpty())
                    <div class="edit-container">
                        <label class="cmsFieldLabel">Capture pre-authorized payments</label>
                        <div class="body-container">
                            <div class="save">
                                <form action="{{ route('shop::orderDetails.capturePayments', [
                                    'id' => $order->id,
                                ]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input class="button" type="submit" name="action" value="Process">
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
