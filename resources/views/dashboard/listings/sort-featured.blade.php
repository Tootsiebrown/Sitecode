@extends('layouts.dashboard')

@section('dashboard-content')
    <h1>Sort Featured Listings</h1>

    <form method="POST" action="{{ route('dashboard.listings.sort-featured') }}">
        @csrf
        <p>Drag into your preferred order</p>
        <ul class="sort-featured-listings" data-component="sort-featured-listings">
            @foreach($listings as $listing)
                <li data-id="{{ $listing->id }}">{{ $listing->title }}</li>
            @endforeach
        </ul>
        <input type="hidden" name="listing_order">

        <button class="btn btn-primary" type="submit" name="submit" value="submit">
            Save Order
        </button>
    </form>
@endsection
