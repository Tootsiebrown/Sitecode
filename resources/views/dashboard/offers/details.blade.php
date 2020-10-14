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
            <td>User</td>
            <td>{{ $offer->user->name }}</td>
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

        @if ($offer->status == 'pending')
            <tr>
                <td>&nbsp;</td>
                <td>
                    <div class="offer-action-form" data-component="offer-action-form">
                        <span data-element="initialButtons">
                            <form class="solo-button form-inline" action="{{ route('dashboard.offers.accept', ['id' => $offer->id]) }}" method="POST">
                                @csrf
                                <button class="btn btn-primary" type="submit">
                                    Accept
                                </button>
                            </form>

                            <form class="solo-button form-inline" action="{{ route('dashboard.offers.reject', ['id' => $offer->id]) }}" method="POST">
                                @csrf
                                <button class="btn btn-primary" type="submit">
                                    Reject
                                </button>
                            </form>

                            <button class="btn btn-primary" data-element="counterButton">Counter</button>
                        </span>

                        <form class="form-horizontal hidden" data-element="counterForm" action="{{ route('dashboard.offers.counter', ['id' => $offer->id]) }}" method="POST">
                            @csrf
                            <div class="row">
                                <label class="col-sm-4">Quantity</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="counter_quantity" value="{{ old('counter_quantity', $offer->offer_quantity) }}">
                                    @include('site.components.field-error', ['field' => 'counter_quantity'])
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4">Price</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="counter_price">
                                    @include('site.components.field-error', ['field' => 'counter_price'])
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4">&nbsp</label>
                                <div class="col-sm-8">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                    <button class="btn btn-primary" data-element="cancelButton">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </td>
            </tr>
        @endif
    </table>

@endsection
