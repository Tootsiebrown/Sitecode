@extends('core::emails.base')

@section('body')
    <table class="email__inner" width="100%" cellpadding="40">
        <tbody>
        <tr>
            <td>
                <h1 class="email__headline">Payment Needed</h1>
                <p>You won the auction for <a href="{{ $listing->url }}">{{ $listing->title }}</a>.</p>

                <p>This deal is good for another 12 hours. Please <a href="{{ route('payForEndedAuction', ['id' => $listing->id]) }}">pay</a> promptly.</p>

            </td>
        </tr>
        </tbody>
    </table>
@endsection
