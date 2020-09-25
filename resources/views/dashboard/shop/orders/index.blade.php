@extends('layouts.dashboard', ['title' => 'Orders'])

@section('dashboard-content')
    <table class="dashboard-table">
        <tr>
            <th>Sequence #</th>
            <th>Email</th>
            <th>Date Placed</th>
            <th>Total</th>
        </tr>
        @forelse($orders as $order)
            <tr>
                <td><a href="{{ route('dashboard.shop.orders.details', ['id' => $order->id]) }}">{{ $order->sequence }}</a></td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->placed_at->format('F j, Y g:i A') }}</td>
                <td class="money">${{ $order->gross_total }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    No orders found
                </td>
            </tr>
        @endforelse
    </table>

    {!! $orders->links() !!}
@endsection
