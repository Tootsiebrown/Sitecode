@extends('layouts.dashboard', ['title' => 'Auction Activity'])

@section('dashboard-content')
    <ul class="auction-activity">
        @foreach ($listings as $listing)
            <li>
                <h3>{{ $listing->title }}</h3>
                @if ($listing->is_bidding_active)
                    <p>
                        @if ($listing->winning_bid->is_mine)
                            You're currently winning!<br>
                            My Bid: ${{ $listing->my_most_recent_bid->bid_amount }}<br>
                            <a href="{{ $listing->url }}">View Listing</a>
                        @else
                            <a href="{{ $listing->url }}">Bid now</a><br/>
                            Current Winning Bid: ${{ $listing->winning_bid->bid_amount }}<br/>
                        @endif
                    </p>
                @else
                    <p>
                        @if ($listing->i_won)
                            @if(!$listing->is_paid_for)
                                <a href="{{ route('payForEndedAuction', ['id' => $listing->id]) }}">Pay now</a><br/>
                            @else
                                <a href="{{ route('dashboard.orders.details', ['id' => $listing->items->first()->orderItem->shipment->order_id]) }}">View Order</a><br/>
                            @endif
                        @else
                            Winning Bid: ${{ $listing->winning_bid->bid_amount }}<br/>
                        @endif
                        My Bid: ${{ $listing->my_most_recent_bid->bid_amount }}
                    </p>
                @endif
            </li>
        @endforeach
    </ul>
    @if ($listings->isEmpty())

    @endif
    {!! $listings->links() !!}
@endsection
