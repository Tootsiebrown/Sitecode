@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Offer {{ $offer->id }}</h1>

    <table class="dashboard-table">
        <tr>
            <td>Status</td>
            <td>{{ $offer->pretty_status }}</td>
        </tr>
        <tr>
            <td>Listing</td>
            <td>
                <a href="{{ route('single_ad', ['id' => $offer->listing->id, 'slug' => $offer->listing->slug]) }}">
                    {{ $offer->listing->title }}
                </a>
            </td>
        </tr>
        <tr>
            <td>Quantity</td>
            <td>{{ $offer->quantity }}</td>
        </tr>
        <tr>
            <td>Price</td>
            <td>{{ Currency::format($offer->price) }}</td>
        </tr>

        @if ($offer->status == 'countered')
            <tr>
                <td>Counter Quantity</td>
                <td>{{ $offer->counter_quantity }}</td>
            </tr>
            <tr>
                <td>Counter Price</td>
                <td>{{ Currency::format($offer->counter_price) }}</td>
            </tr>
        @endif

        @if ($offer->status == 'countered')
            <tr>
                <td>&nbsp;</td>
                <td>
                    <div class="offer-action-form" data-component="offer-action-form">
                        <span data-element="initialButtons">
                            <form class="solo-button form-inline" action="{{ route('dashboard.my-offers.accept', ['id' => $offer->id]) }}" method="POST">
                                @csrf
                                <button class="btn btn-primary" type="submit">
                                    Accept
                                </button>
                            </form>

                            <form class="solo-button form-inline" action="{{ route('dashboard.my-offers.reject', ['id' => $offer->id]) }}" method="POST">
                                @csrf
                                <button class="btn btn-primary" type="submit">
                                    Reject
                                </button>
                            </form>
                        </span>
                    </div>
                    @include('site.components.field-error', ['field' => 'inventory'])
                </td>
            </tr>
        @endif
    </table>


    @if ($offer->status === 'accepted' || $offer->status == 'counter_accepted')
        <a class="btn btn-primary" href="{{ route('payForAcceptedOffer', ['id' => $offer->id]) }}">Purchase</a>
    @endif

@endsection
