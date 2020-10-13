@extends('layouts.dashboard')

@section('dashboard-content')
    @if ($errors->has('id'))
        @include('site.components.field-error', ['field' => 'id'])
    @endif
    <h1>Offers</h1>

    <table class="dashboard-table">
        <tr>
            <th>Listing</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach ($offers as $offer)
            <tr>
                <td>{{ $offer->listing->title }}</td>
                <td>{{ $offer->counter_quantity ?? $offer->quantity }}</td>
                <td>{{ Currency::format($offer->counter_price ?? $offer->price) }}</td>
                <td>{{ $offer->pretty_status }}</td>
                <td>
                    @if ($offer->status === 'accepted' || $offer->status == 'counter_accepted')
                        <a href="{{ route('payForAcceptedOffer', ['id' => $offer->id]) }}">Purchase</a>
                    @elseif ($offer->status === 'countered')
                        <a href="{{ route('dashboard.my-offers.show', ['id' => $offer->id]) }}">
                            Review
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    {!! $offers->links() !!}
@endsection
