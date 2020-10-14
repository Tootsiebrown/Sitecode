@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Auctions</h1>

    <table class="dashboard-table">
        <tr>
            <th>Listing</th>
            <th>Expires At</th>
            <th>Bids</th>
            <th>Current Winning Bid</th>
            <th>Purchased</th>
        </tr>
        @foreach ($listings as $listing)
            <tr>
                <td>{{ $listing->title }}</td>
                <td>{{ $listing->expired_at->format('Y-m-d H:i') }}</td>
                <td>{{ $listing->bids->count() }}</td>
                <td>
                    @if ($listing->bids->isNotEmpty())
                        {{ Currency::format($listing->bids->sortBy('bid_amount')->first()->bid_amount) }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    {{ $listing->items->first()->order_item_id ? 'Yes' : 'No' }}
                </td>
            </tr>
        @endforeach
    </table>
    {!! $listings->links() !!}
@endsection
