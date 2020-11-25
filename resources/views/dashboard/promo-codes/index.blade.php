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
            <th>Amount</th>
            <th>Expiration</th>
            <th>Permitted Uses</th>
            <th>Used Count</th>
            <th>Includes Shipping</th>
            <th>Minimum Order</th>
            <th>Category</th>
        </tr>
        @foreach ($coupons as $coupon)
            <tr>
                <td><a href="{{ route('dashboard.promoCodes.edit', ['id' => $coupon->id]) }}"><i class="fa fa-edit"></i></a></td>
                <td>{{ $coupon->id }}</td>
                <td>{{ $coupon->title }}</td>
                <td>{{ $coupon->code }}</td>
                <td>{{ $coupon->type == 'dollars' ? Currency::format($coupon->dollars) : $coupon->percent . '%' }}</td>
                <td>{{ $coupon->expired_at ? $coupon->expired_at->format('Y-m-d') : 'N/A' }}</td>
                <td>{{ $coupon->one_time ? 1 : ($coupon->permitted_uses ?: '∞') }}</td>
                <td>{{ $coupon->uses }}</td>
                <td>{{ $coupon->include_shipping ? 'Yes' : 'No' }}</td>
                <td>{{ $coupon->minimum_order ? Currency::format($coupon->minimum_order) : 'N/A' }}</td>
                <td>{{ $coupon->category ? $coupon->category->breadcrumb : 'N/A' }}</td>
            </tr>
        @endforeach
    </table>
    {{ $coupons->links() }}
@endsection
