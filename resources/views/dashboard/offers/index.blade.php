@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Offers</h1>

    @if (request('page', 1))
        <table class="dashboard-table">
            <tr>
                <th>Current Pending</th>
                <th>New in 24 Hours</th>
            </tr>
            <tr>
                <td>{{ $pendingCount }}</td>
                <td>{{ $rollingCount }}</td>
            </tr>
        </table>
    @endif

    <table class="dashboard-table">
        <tr>
            <th>Listing</th>
            <th>Created At</th>
            <th>Last Updated At</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Status</th>
            <th>Review</th>
        </tr>
        @foreach ($offers as $offer)
            <tr>
                <td>{{ $offer->listing->title }}</td>
                <td>{{ $offer->created_at->format('Y-m-d H:i') }}</td>
                <td>{{ $offer->updated_at->format('Y-m-d H:i') }}</td>
                <td>{{ $offer->counter_quantity ?? $offer->quantity }}</td>
                <td>{{ Currency::format($offer->counter_price ?? $offer->price) }}</td>
                <td>{{ $offer->pretty_status }}</td>
                <td>
                    <a href="{{ route('dashboard.offers.show', ['id' => $offer->id]) }}">
                        Review
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $offers->links() !!}
@endsection
