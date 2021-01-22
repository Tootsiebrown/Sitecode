@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>
        Order {{ $order->ebay_id }}
        @if ($order->canceled)
            <span class="alert alert-danger">CANCELED</span>
        @endif
    </h1>

    <table class="dashboard-table">
        <thead>
            <tr>
                <th>Item SKU</th>
                <th>Bin</th>
                <th>Name</th>
                <th>Listing SKU</th>
            </tr>
        </thead>

        @foreach ($order->items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->bin }}</td>
                <td>{{ $item->listing->title }}</td>
                <td>{{ $item->listing->id }}</td>
            </tr>
        @endforeach
    </table>

    @if ($order->canceled)
        <h3 class="alert alert-danger">ORDER CANCELED</h3>
        <p>By: {{ $order->canceledBy->email }}</p>
        <p>At: {{ $order->canceled_at }}</p>
    @elseif (! $order->isPending())
        <section>
            <h3>Cancel Order</h3>
            <p>
                This cannot be undone. This will remove the items from the order and place them back into purchasable
                inventory. To refund orders, shipping, etc., go to Ebay.
            </p>
            <form
                method="POST"
                action="{{ route('dashboard.ebay.orders.cancel', ['id' => $order->id]) }}"
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
@endsection
