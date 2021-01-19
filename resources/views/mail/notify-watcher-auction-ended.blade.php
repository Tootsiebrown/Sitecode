@extends('core::emails.base')

@section('body')
    <table class="email__inner" style=""
           width="100%" cellpadding="40">
        <tbody>
        <tr>
            <td>
                <h1 class="email__headline">An auction you were watching has ended.</h1>
                <h2 class="email__subhead">
                    <a href="{{ route('singleListing', ['id' => $listing->id, 'slug' => $listing->slug]) }}">
                        {{ $listing->title }}
                    </a>
                </h2>
                @if ($listing->winning_bid)
                    <p>The winning bid was {{ Currency::format($listing->winning_bid->bid_amount) }}</p>
                @else
                    No one made a winning bid for this item.
                @endif
            </td>
        </tr>
        </tbody>
    </table>
@endsection
