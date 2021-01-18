@extends('layouts.dashboard', ['title' => 'Orders'])

@section('dashboard-content')
    <table class="dashboard-table">
        <tr>
            <th>Order ID</th>
            <th>Date Synced</th>
        </tr>
        @forelse($orders as $order)
            <tr>
                <td><a href="{{ route('dashboard.ebay.orders.details', ['id' => $order->id]) }}">{{ $order->ebay_id }}</a></td>
                <td>{{ $order->created_at->format('F j, Y g:i A') }}</td>
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