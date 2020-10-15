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
                <td>
                    <a href="{{ $listing->url }}">
                        {{ $listing->title }}
                    </a>
                </td>
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
                    @if ($listing->items->isNotEmpty())
                        {{ $listing->items->first()->order_item_id ? 'Yes' : 'No' }}
                    @else
                        No
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    {!! $listings->links() !!}
@endsection
