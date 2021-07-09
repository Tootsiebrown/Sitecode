@extends('layouts.dashboard', ['title' => 'Orders'])

@section('dashboard-content')z
    <table class="dashboard-table">
        <tr>
            <th>Order ID</th>
            <th>Date Placed</th>
            <th>Total</th>
        </tr>
        @forelse($orders as $order)
            <tr>
                <td><a href="{{ route('dashboard.orders.details', ['id' => $order->id]) }}">{{ $order->sequence }}</a></td>
                <td>{{ $order->placed_at->format('F j, Y g:i A') }}</td>
                <td class="money">{{ Currency::format($order->total) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">
                    No orders found
                </td>
            </tr>
        @endforelse
    </table>
@endsection
