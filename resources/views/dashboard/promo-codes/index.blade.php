@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Promo Codes</h1>

    {{ $coupons->links() }}

    <a href="{{ route('dashboard.promoCodes.create') }}">New Promo Code</a>

    <table class="dashboard-table">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Code</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Expiration</th>
            <th>One-Time</th>
            <th>Includes Shipping</th>
            <th>Minimum Order</th>
        </tr>
        @foreach ($coupons as $coupon)
            <tr>
                <td>{{ $coupon->id }}</td>
                <td>{{ $coupon->title }}</td>
                <td>{{ $coupon->code }}</td>
                <td>{{ $coupon->type }}</td>
                <td>{{ $coupon->discount }}</td>
                <td>{{ $coupon->expired_at }}</td>
                <td>{{ $coupon->one_time ? 'Yes' : 'No' }}</td>
                <td>{{ $coupon->includes_shipping ? 'Yes' : 'No' }}</td>
                <td>{{ $coupon->minimum_order }}</td>
            </tr>
        @endforeach
    </table>
@endsection
