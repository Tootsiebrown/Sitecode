@extends('core::emails.base')

@section('body')
    <table class="email__inner" style=""
           width="100%" cellpadding="40">
        <tbody>
        <tr>
            <td>
                <h1 class="email__headline">New Bid on an Auction You're Watching</h1>
                <h2 class="email__subhead">
                    <a href="{{ route('singleListing', ['id' => $bid->listing->id, 'slug' => $bid->listing->slug]) }}">
                        {{ $bid->listing->title }}
                    </a>
                </h2>
                <p>New Bid: {{ Currency::format($bid->bid_amount) }}</p>
            </td>
        </tr>
        </tbody>
    </table>
@endsection
