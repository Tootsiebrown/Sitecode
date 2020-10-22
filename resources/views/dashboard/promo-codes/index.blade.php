@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Promo Codes</h1>

    <a href="{{ route('dashboard.promoCodes.create') }}">New Promo Code</a>

    {{ $coupons->links() }}

    <table class="dashboard-table">
        <tr>
            <th>Edit</th>
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
                <td><a href="{{ route('dashboard.promoCodes.edit', ['id' => $coupon->id]) }}"><i class="fa fa-edit"></i></a></td>
                <td>{{ $coupon->id }}</td>
                <td>{{ $coupon->title }}</td>
                <td>{{ $coupon->code }}</td>
                <td>{{ $coupon->type }}</td>
                <td>{{ $coupon->type == 'dollars' ? Currency::format($coupon->dollars) : $coupon->percent . '%' }}</td>
                <td>{{ $coupon->expired_at ? $coupon->expired_at->format('Y-m-d') : 'N/A' }}</td>
                <td>{{ $coupon->one_time ? 'Yes' : 'No' }}</td>
                <td>{{ $coupon->include_shipping ? 'Yes' : 'No' }}</td>
                <td>{{ $coupon->minimum_order ? Currency::format($coupon->minimum_order) : '' }}</td>
            </tr>
        @endforeach
    </table>
    {{ $coupons->links() }}
@endsection
